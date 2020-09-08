<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DigitalCz\DigiSign\Api\AccountApi;
use DigitalCz\DigiSign\Api\DocumentApi;
use DigitalCz\DigiSign\Api\EnvelopeApi;
use DigitalCz\DigiSign\Api\FileApi;
use DigitalCz\DigiSign\Api\RecipientApi;
use DigitalCz\DigiSign\Api\TagApi;
use DigitalCz\DigiSign\Auth\AuthTokenProvider;
use DigitalCz\DigiSign\Http\Client;
use DigitalCz\DigiSign\ValueObject\Request\Credentials;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Discovery\Psr18ClientDiscovery;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class DigiSign
{

    /**
     * @var Client
     */
    private $client;
    /**
     * @var RequestFactoryInterface
     */
    private $httpRequestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $httpStreamFactory;

    public function __construct(
        string $clientId,
        string $clientSecret,
        AuthTokenProvider $authTokenProvider,
        ClientInterface $httpClient = null,
        RequestFactoryInterface $httpRequestFactory = null,
        StreamFactoryInterface $httpStreamFactory = null
    ) {
        $httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $this->httpRequestFactory = $httpRequestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $this->httpStreamFactory = $httpStreamFactory ?? Psr17FactoryDiscovery::findStreamFactory();

        $this->client = new Client(
            new Credentials($clientId, $clientSecret),
            $httpClient,
            $this->httpRequestFactory,
            $this->httpStreamFactory,
            $authTokenProvider
        );
    }

    public function getAccountApi(): AccountApi
    {
        return new AccountApi($this->client, $this->httpRequestFactory, $this->httpStreamFactory);
    }

    public function getFileApi(): FileApi
    {
        return new FileApi($this->client, $this->httpRequestFactory, $this->httpStreamFactory);
    }

    public function getDocumentApi(): DocumentApi
    {
        return new DocumentApi($this->client, $this->httpRequestFactory, $this->httpStreamFactory);
    }

    public function getRecipientApi(): RecipientApi
    {
        return new RecipientApi($this->client, $this->httpRequestFactory, $this->httpStreamFactory);
    }

    public function getEnvelopeApi(): EnvelopeApi
    {
        return new EnvelopeApi($this->client, $this->httpRequestFactory, $this->httpStreamFactory);
    }

    public function getTagApi(): TagApi
    {
        return new TagApi($this->client, $this->httpRequestFactory, $this->httpStreamFactory);
    }
}
