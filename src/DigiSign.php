<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DigitalCz\DigiSign\Auth\ApiKeyCredentials;
use DigitalCz\DigiSign\Auth\ApiKeyTokenProvider;
use DigitalCz\DigiSign\Auth\CachingTokenProvider;
use DigitalCz\DigiSign\Auth\Credentials;
use DigitalCz\DigiSign\Auth\Token;
use DigitalCz\DigiSign\Auth\TokenProvider;
use DigitalCz\DigiSign\Endpoint\AccountEndpoint;
use DigitalCz\DigiSign\Endpoint\AuthEndpoint;
use DigitalCz\DigiSign\Endpoint\DeliveriesEndpoint;
use DigitalCz\DigiSign\Endpoint\EndpointInterface;
use DigitalCz\DigiSign\Endpoint\EnvelopesEndpoint;
use DigitalCz\DigiSign\Endpoint\FilesEndpoint;
use DigitalCz\DigiSign\Endpoint\ImagesEndpoint;
use DigitalCz\DigiSign\Endpoint\WebhooksEndpoint;
use DigitalCz\DigiSign\Exception\RuntimeException;
use Psr\Http\Message\ResponseInterface;

final class DigiSign implements EndpointInterface
{
    public const VERSION = '1.0.0';
    public const API_BASE = 'https://api.digisign.org';
    public const API_BASE_TESTING = 'https://api.digisign.digital.cz';

    /** The base URL for requests */
    private string $apiBase = self::API_BASE;

    /** The credentials used to authenticate to API */
    private Credentials $credentials;

    /** The  */
    private TokenProvider $tokenProvider;

    /** The client used to send requests */
    private DigiSignClient $client;

    /** @var array<string, string> */
    private array $versions = [];

    /**
     * Available options:
     *  access_key      - string; ApiKey access key
     *  secret_key      - string; ApiKey secret key
     *  client          - DigitalCz\DigiSign\DigiSignClient instance with your custom PSR17/18 objects
     *  token_provider  - DigitalCz\DigiSign\Auth\TokenProvider instance for your custom auth logic
     *  cache           - Psr\SimpleCache\CacheInterface for caching Auth tokens
     *  testing         - bool; whether to use testing or production API
     *
     * @param mixed[] $options
     */
    public function __construct(array $options = [])
    {
        if (isset($options['access_key'], $options['secret_key'])) {
            $this->setCredentials(new ApiKeyCredentials($options['access_key'], $options['secret_key']));
        }

        $this->setClient($options['client'] ?? new DigiSignClient());
        $this->setTokenProvider($options['token_provider'] ?? new ApiKeyTokenProvider($this));

        // if cache is provided, wrap tokenProvider with cache decorator
        if (isset($options['cache'])) {
            $this->setTokenProvider(new CachingTokenProvider($this->tokenProvider, $options['cache']));
        }

        $this->useTesting($options['testing'] ?? false);
        $this->addVersion('digitalcz/digisign', self::VERSION);
        $this->addVersion('PHP', PHP_VERSION);
    }

    public function setCredentials(Credentials $credentials): void
    {
        $this->credentials = $credentials;
    }

    public function setClient(DigiSignClient $client): void
    {
        $this->client = $client;
    }

    public function setTokenProvider(TokenProvider $tokenProvider): void
    {
        $this->tokenProvider = $tokenProvider;
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
        // default headers
        $options['headers'] = [
            'Accept' => 'application/json',
            'User-Agent' => $this->createUserAgent(),
        ];

        // disable authorization header if options[no_auth]=true
        if (($options['no_auth'] ?? false) !== true) {
            $options['bearer'] = $this->getAuthToken()->getToken();
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

    private function createAuthorization(): string
    {
        return 'Bearer ' . $this->getAuthToken()->getToken();
    }

    private function getAuthToken(): Token
    {
        if (!isset($this->credentials)) {
            throw new RuntimeException(
                'No credentials were set, Please use setCredentials() ' .
                'or provide constructor options access_key/secret_key',
            );
        }

        return $this->tokenProvider->provide($this->credentials);
    }
}
