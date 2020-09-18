<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Auth\AuthTokenProvider;
use DigitalCz\DigiSign\Dummy\Auth\InMemoryCache;
use DigitalCz\DigiSign\Http\RequestBuilder;
use DigitalCz\DigiSign\Http\TokenResolver;
use DigitalCz\DigiSign\Http\UriResolver;
use DigitalCz\DigiSign\Model\Credentials;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;

abstract class BaseApiTestCase extends TestCase
{

    /**
     * @var Client
     */
    protected $httpClient;

    /**
     * @var RequestBuilder
     */
    protected $requestBuilder;

    protected function setUp(): void
    {
        $this->httpClient = new Client();

        $contents = file_get_contents(__DIR__ . '/../Dummy/Responses/auth_token.json');
        $tokenData = json_decode($contents !== false ? $contents : '', true);

        $inMemoryCache = new InMemoryCache();
        $inMemoryCache->set('accessKey', $tokenData);

        $authTokenProvider = new AuthTokenProvider($inMemoryCache);
        $uriResolver = new UriResolver();
        $requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        $tokenResolver = new TokenResolver(
            new AuthApi($this->httpClient, $requestFactory, $streamFactory, $uriResolver),
            new Credentials('accessKey', 'secretKey'),
            $authTokenProvider
        );

        $this->requestBuilder = new RequestBuilder($requestFactory, $streamFactory, $tokenResolver, $uriResolver);
    }
}
