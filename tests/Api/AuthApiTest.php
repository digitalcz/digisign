<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Http\UriResolver;
use DigitalCz\DigiSign\Model\Credentials;
use Http\Discovery\Psr17FactoryDiscovery;
use Http\Mock\Client;
use PHPUnit\Framework\TestCase;
use Psr\Http\Message\ResponseInterface;

class AuthApiTest extends TestCase
{

    public function testAuthApi(): void
    {
        $httpClient = new Client();

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

        $authToken = $api->getAuthToken(new Credentials('accessKey', 'secretKey'));

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals('YourSecretToken', $authToken->getToken());
        self::assertEquals(1596114005, $authToken->getExpiresAt());
    }
}
