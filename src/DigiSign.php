<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DigitalCz\DigiSign\Auth\ApiKeyCredentials;
use DigitalCz\DigiSign\Auth\CachedCredentials;
use DigitalCz\DigiSign\Auth\Credentials;
use DigitalCz\DigiSign\Endpoint\AccountEndpoint;
use DigitalCz\DigiSign\Endpoint\AuthEndpoint;
use DigitalCz\DigiSign\Endpoint\DeliveriesEndpoint;
use DigitalCz\DigiSign\Endpoint\EndpointInterface;
use DigitalCz\DigiSign\Endpoint\EnumsEndpoint;
use DigitalCz\DigiSign\Endpoint\EnvelopesEndpoint;
use DigitalCz\DigiSign\Endpoint\EnvelopeTemplatesEndpoint;
use DigitalCz\DigiSign\Endpoint\FilesEndpoint;
use DigitalCz\DigiSign\Endpoint\ImagesEndpoint;
use DigitalCz\DigiSign\Endpoint\LabelsEndpoint;
use DigitalCz\DigiSign\Endpoint\MyEndpoint;
use DigitalCz\DigiSign\Endpoint\WebhooksEndpoint;
use DigitalCz\DigiSign\Exception\InvalidSignatureException;
use InvalidArgumentException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;

final class DigiSign implements EndpointInterface
{
    public const VERSION = '1.6.0';
    public const API_BASE = 'https://api.digisign.org';
    public const API_BASE_TESTING = 'https://api.digisign.digital.cz';

    /** @var string The base URL for requests */
    private $apiBase = self::API_BASE;

    /** @var Credentials The credentials used to authenticate to API */
    private $credentials;

    /** @var DigiSignClient The client used to send requests */
    private $client;

    /** @var array<string, string> */
    private $versions = [];

    /** @var int The tolerance for webhook signature age validation (in seconds) */
    private $signatureTolerance = 300;

    /**
     * Available options:
     *  access_key          - string; ApiKey access key
     *  secret_key          - string; ApiKey secret key
     *  credentials         - DigitalCz\DigiSign\Auth\Credentials instance
     *  client              - DigitalCz\DigiSign\DigiSignClient instance with your custom PSR17/18 objects
     *  http_client         - Psr\Http\Client\ClientInterface instance of your custom PSR18 client
     *  cache               - Psr\SimpleCache\CacheInterface for caching Credentials auth Tokens
     *  testing             - bool; whether to use testing or production API
     *  api_base            - string; override the base API url
     *  signature_tolerance - int; The tolerance for webhook signature age validation (in seconds)
     *
     * @param mixed[] $options
     */
    public function __construct(array $options = [])
    {
        $httpClient = $options['http_client'] ?? null;
        $this->setClient($options['client'] ?? new DigiSignClient($httpClient));
        $this->useTesting($options['testing'] ?? false);
        $this->addVersion('digitalcz/digisign', self::VERSION);
        $this->addVersion('PHP', PHP_VERSION);

        if (isset($options['api_base'])) {
            if (!is_string($options['api_base'])) {
                throw new InvalidArgumentException('Invalid value for "api_base" option');
            }

            $this->setApiBase($options['api_base']);
        }

        if (isset($options['access_key'], $options['secret_key'])) {
            $this->setCredentials(new ApiKeyCredentials($options['access_key'], $options['secret_key']));
        }

        if (isset($options['credentials'])) {
            if (!$options['credentials'] instanceof Credentials) {
                throw new InvalidArgumentException('Invalid value for "credentials" option');
            }

            $this->setCredentials($options['credentials']);
        }

        // if cache is provided, wrap Credentials with cache decorator
        if (isset($options['cache'])) {
            if (!$options['cache'] instanceof CacheInterface) {
                throw new InvalidArgumentException('Invalid value for "cache" option');
            }

            $this->setCache($options['cache']);
        }

        if (isset($options['signature_tolerance'])) {
            if (!is_int($options['signature_tolerance'])) {
                throw new InvalidArgumentException('Invalid value for "signature_tolerance" option');
            }

            $this->setSignatureTolerance($options['signature_tolerance']);
        }
    }

    /**
     * @throws InvalidSignatureException
     */
    public function validateSignature(string $payload, string $header, string $secret): void
    {
        if (preg_match('/t=(?<t>\d+),s=(?<s>\w+)/', $header, $matches) !== 1) {
            throw new InvalidSignatureException('Unable to parse signature header');
        }

        $ts = (int)($matches['t'] ?? 0);
        $signature = $matches['s'] ?? '';

        if ($ts < time() - $this->signatureTolerance) {
            throw new InvalidSignatureException("Request is older than {$this->signatureTolerance} seconds");
        }

        $expected = hash_hmac('sha256', $ts . '.' . $payload, $secret);

        if (hash_equals($expected, $signature) === false) {
            throw new InvalidSignatureException('Signature is invalid');
        }
    }

    public function setCache(CacheInterface $cache): void
    {
        $credentials = $this->getCredentials();

        // if credentials are already decorated, do not double wrap, but get inner
        if ($credentials instanceof CachedCredentials) {
            $credentials = $credentials->getInner();
        }

        $this->setCredentials(new CachedCredentials($credentials, $cache));
    }

    public function getCredentials(): Credentials
    {
        if (!isset($this->credentials)) {
            throw new LogicException(
                'No credentials were provided, Please use setCredentials() ' .
                'or constructor options to set them.'
            );
        }

        return $this->credentials;
    }

    public function setCredentials(Credentials $credentials): void
    {
        $this->credentials = $credentials;
    }

    public function setClient(DigiSignClient $client): void
    {
        $this->client = $client;
    }

    public function useTesting(bool $bool = true): void
    {
        if ($bool) {
            $this->setApiBase(self::API_BASE_TESTING);
        } else {
            $this->setApiBase(self::API_BASE);
        }
    }

    public function setApiBase(string $apiBase): void
    {
        $this->apiBase = rtrim(trim($apiBase), '/');
    }

    public function addVersion(string $tool, string $version = ''): void
    {
        $this->versions[$tool] = $version;
    }

    public function removeVersion(string $tool): void
    {
        unset($this->versions[$tool]);
    }

    public function setSignatureTolerance(int $signatureTolerance): void
    {
        $this->signatureTolerance = $signatureTolerance;
    }

    /** @inheritDoc */
    public function request(string $method, string $path = '', array $options = []): ResponseInterface
    {
        $options['user-agent'] = $this->createUserAgent();

        // disable authorization header if options[no_auth]=true
        if (($options['no_auth'] ?? false) !== true) {
            $options['auth_bearer'] = $options['auth_bearer'] ?? $this->createBearer();
        }

        return $this->client->request($method, $this->apiBase . $path, $options);
    }

    public function auth(): AuthEndpoint
    {
        return new AuthEndpoint($this);
    }

    public function account(): AccountEndpoint
    {
        return new AccountEndpoint($this);
    }

    public function envelopes(): EnvelopesEndpoint
    {
        return new EnvelopesEndpoint($this);
    }

    public function envelopeTemplates(): EnvelopeTemplatesEndpoint
    {
        return new EnvelopeTemplatesEndpoint($this);
    }

    public function deliveries(): DeliveriesEndpoint
    {
        return new DeliveriesEndpoint($this);
    }

    public function files(): FilesEndpoint
    {
        return new FilesEndpoint($this);
    }

    public function images(): ImagesEndpoint
    {
        return new ImagesEndpoint($this);
    }

    public function labels(): LabelsEndpoint
    {
        return new LabelsEndpoint($this);
    }

    public function webhooks(): WebhooksEndpoint
    {
        return new WebhooksEndpoint($this);
    }

    public function enums(): EnumsEndpoint
    {
        return new EnumsEndpoint($this);
    }

    public function my(): MyEndpoint
    {
        return new MyEndpoint($this);
    }

    private function createUserAgent(): string
    {
        $userAgent = '';

        foreach ($this->versions as $tool => $version) {
            $userAgent .= $tool;
            $userAgent .= $version !== '' ? ":$version" : '';
            $userAgent .= ' ';
        }

        return $userAgent;
    }

    private function createBearer(): string
    {
        return $this->getCredentials()->provide($this)->getToken();
    }
}
