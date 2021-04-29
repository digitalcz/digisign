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
use DigitalCz\DigiSign\Endpoint\EnvelopesEndpoint;
use DigitalCz\DigiSign\Endpoint\FilesEndpoint;
use DigitalCz\DigiSign\Endpoint\ImagesEndpoint;
use DigitalCz\DigiSign\Endpoint\WebhooksEndpoint;
use InvalidArgumentException;
use LogicException;
use Psr\Http\Message\ResponseInterface;
use Psr\SimpleCache\CacheInterface;

final class DigiSign implements EndpointInterface
{
    public const VERSION = '1.0.0';
    public const API_BASE = 'https://api.digisign.org';
    public const API_BASE_TESTING = 'https://api.digisign.digital.cz';

    /** The base URL for requests */
    private string $apiBase = self::API_BASE;

    /** The credentials used to authenticate to API */
    private Credentials $credentials;

    /** The client used to send requests */
    private DigiSignClient $client;

    /** @var array<string, string> */
    private array $versions = [];

    /**
     * Available options:
     *  access_key      - string; ApiKey access key
     *  secret_key      - string; ApiKey secret key
     *  credentials     - DigitalCz\DigiSign\Auth\Credentials instance
     *  client          - DigitalCz\DigiSign\DigiSignClient instance with your custom PSR17/18 objects
     *  cache           - Psr\SimpleCache\CacheInterface for caching Credentials auth Tokens
     *  testing         - bool; whether to use testing or production API
     *
     * @param mixed[] $options
     */
    public function __construct(array $options = [])
    {
        $this->setClient($options['client'] ?? new DigiSignClient());
        $this->useTesting($options['testing'] ?? false);
        $this->addVersion('digitalcz/digisign', self::VERSION);
        $this->addVersion('PHP', PHP_VERSION);

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
                'or constructor options to set them.',
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

    /** @inheritDoc */
    public function request(string $method, string $path = '', array $options = []): ResponseInterface
    {
        $options['user-agent'] = $this->createUserAgent();

        // disable authorization header if options[no_auth]=true
        if (($options['no_auth'] ?? false) !== true) {
            $options['bearer'] = $this->createBearer();
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

    public function webhooks(): WebhooksEndpoint
    {
        return new WebhooksEndpoint($this);
    }

    private function createUserAgent(): string
    {
        $userAgent = '';

        foreach ($this->versions as $tool => $version) {
            $userAgent .= sprintf("%s:%s ", $tool, $version);
        }

        return $userAgent;
    }

    private function createBearer(): string
    {
        return $this->getCredentials()->provide($this)->getToken();
    }
}
