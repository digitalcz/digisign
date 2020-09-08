<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DigitalCz\DigiSign\Api\AccountApi;
use DigitalCz\DigiSign\Api\AuthApi;
use DigitalCz\DigiSign\Api\Envelope\EnvelopeApi;
use DigitalCz\DigiSign\Api\Envelope\EnvelopeDocumentApi;
use DigitalCz\DigiSign\Api\Envelope\EnvelopeRecipientApi;
use DigitalCz\DigiSign\Api\FileApi;
use DigitalCz\DigiSign\Auth\AuthTokenProvider;
use DigitalCz\DigiSign\Http\RequestBuilder;
use DigitalCz\DigiSign\Http\TokenResolver;
use DigitalCz\DigiSign\Http\UriResolver;
use DigitalCz\DigiSign\Model\Credentials;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class DigiSign
{

    /**
     * @var ClientInterface
     */
    private $httpClient;
    /**
     * @var RequestFactoryInterface
     */
    private $httpRequestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $httpStreamFactory;
    /**
     * @var RequestBuilder
     */
    private $requestBuilder;

    public function __construct(
        string $clientId,
        string $clientSecret,
        AuthTokenProvider $authTokenProvider,
        ClientInterface $httpClient = null,
        RequestFactoryInterface $httpRequestFactory = null,
        StreamFactoryInterface $httpStreamFactory = null,
        bool $sandbox = false
    ) {
        $this->httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->httpRequestFactory = $httpRequestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->httpStreamFactory = $httpStreamFactory ?? Psr17FactoryDiscovery::findStreamFactory();

        $uriResolver = new UriResolver($sandbox);

        $tokenResolver = new TokenResolver(
            new AuthApi($this->httpClient, $this->httpRequestFactory, $this->httpStreamFactory, $uriResolver),
            new Credentials($clientId, $clientSecret),
            $authTokenProvider
        );

        $this->requestBuilder = new RequestBuilder(
            $this->httpRequestFactory,
            $this->httpStreamFactory,
            $tokenResolver,
            $uriResolver
        );
    }

    public function getAccountApi(): AccountApi
    {
        return new AccountApi($this->httpClient, $this->requestBuilder);
    }

    public function getFileApi(): FileApi
    {
        return new FileApi($this->httpClient, $this->requestBuilder);
    }

    public function getEnvelopeDocumentApi(): EnvelopeDocumentApi
    {
        return new EnvelopeDocumentApi($this->httpClient, $this->requestBuilder);
    }

    public function getEnvelopeRecipientApi(): EnvelopeRecipientApi
    {
        return new EnvelopeRecipientApi($this->httpClient, $this->requestBuilder);
    }

    public function getEnvelopeApi(): EnvelopeApi
    {
        return new EnvelopeApi($this->httpClient, $this->requestBuilder);
    }

    public function getTagApi(): TagApi
    {
        return new TagApi($this->client, $this->httpRequestFactory, $this->httpStreamFactory);
    }
}
