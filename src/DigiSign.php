<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DigitalCz\DigiSign\Api\AccountApi;
use DigitalCz\DigiSign\Auth\AuthTokenProvider;
use DigitalCz\DigiSign\Http\Client;
use DigitalCz\DigiSign\Http\RequestFactory;
use DigitalCz\DigiSign\Request\Account\AccountGetRequest;
use DigitalCz\DigiSign\Response\Account\AccountGetResponse;
use DigitalCz\DigiSign\ValueObject\Account;
use DigitalCz\DigiSign\ValueObject\Credentials;
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
     * @var RequestFactory
     */
    private $requestFactory;

    public function __construct(
        string $clientId,
        string $clientSecret,
        AuthTokenProvider $authTokenProvider,
        ClientInterface $httpClient = null,
        RequestFactoryInterface $httpRequestFactory = null,
        StreamFactoryInterface $httpStreamFactory = null
    ) {
        $httpClient = $httpClient ?? Psr18ClientDiscovery::find();
        $httpRequestFactory = $httpRequestFactory ?? Psr17FactoryDiscovery::findRequestFactory();
        $httpStreamFactory = $httpStreamFactory ?? Psr17FactoryDiscovery::findStreamFactory();

        $this->requestFactory = new RequestFactory($httpRequestFactory, $httpStreamFactory);

        $this->client = new Client(
            new Credentials($clientId, $clientSecret),
            $httpClient,
            $authTokenProvider,
            $this->requestFactory
        );
    }

    public function getAccountApi(): AccountApi
    {
        return new AccountApi($this->client, $this->requestFactory);
    }
}
