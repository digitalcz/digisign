<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http;

use DigitalCz\DigiSign\Api\AuthApi;
use DigitalCz\DigiSign\Auth\AuthTokenProvider;
use DigitalCz\DigiSign\Dummy\Auth\InMemoryCache;
use DigitalCz\DigiSign\Model\Credentials;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class TokenResolverTest extends TestCase
{

    public function testTokenResolver(): void
    {
        $httpClient = new Client();
        $inMemoryCache = new InMemoryCache();
        $authTokenProvider = new AuthTokenProvider($inMemoryCache);
        $uriResolver = new UriResolver();
        $requestFactory = Psr17FactoryDiscovery::findRequestFactory();
        $streamFactory = Psr17FactoryDiscovery::findStreamFactory();

        //auth token get response
        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../Dummy/Responses/auth_token.json')
            );

        $httpClient->addResponse($httpResponse);

        $api = new AuthApi(
            $httpClient,
            $requestFactory,
            $streamFactory,
            $uriResolver
        );

        $tokenResolver = new TokenResolver(
            $api,
            new Credentials('accessKey', 'secretKey'),
            $authTokenProvider
        );

        $token = $tokenResolver->resolve();

        self::assertEquals('YourSecretToken', $token->getToken());
        self::assertEquals('1596114005', $token->getExpiresAt());
    }
}
