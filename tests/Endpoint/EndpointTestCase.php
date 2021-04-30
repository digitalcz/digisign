<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Auth\Token;
use DigitalCz\DigiSign\Auth\TokenCredentials;
use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\DigiSignClient;
use Http\Mock\Client;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use RuntimeException;

abstract class EndpointTestCase extends TestCase
{
    protected static Client $httpClient;
    protected static DigiSign $digiSign;

    protected function setUp(): void
    {
        self::$httpClient = new Client();
        self::$httpClient->setDefaultResponse(new Response(200, [], '{}'));
        self::$digiSign = new DigiSign(
            [
                'credentials' => new TokenCredentials(new Token('token', time())),
                'client' => new DigiSignClient(self::$httpClient),
            ],
        );
    }

    /**
     * @param mixed[] $result
     */
    protected static function addResponse(int $code, array $result): void
    {
        self::$httpClient->addResponse(new Response($code, [], json_encode($result, JSON_THROW_ON_ERROR)));
    }

    protected static function assertDefaultEndpointPath(EndpointInterface $endpoint, string $path): void
    {
        $endpoint->request('GET');
        self::assertLastRequest('GET', $path);
    }

    /**
     * @param mixed[]|null $body
     */
    protected static function assertLastRequest(string $method, string $path, ?array $body = null): void
    {
        $lastRequest = self::$httpClient->getLastRequest();

        if ($lastRequest === false) {
            throw new RuntimeException('No last request');
        }

        self::assertSame($method, $lastRequest->getMethod());
        self::assertSame('https://api.digisign.org' . $path, (string)$lastRequest->getUri());
        self::assertSame('Bearer token', $lastRequest->getHeaderLine('Authorization'));

        if ($body !== null) {
            self::assertSame(json_encode($body, JSON_THROW_ON_ERROR), (string)$lastRequest->getBody());
        }
    }
}
