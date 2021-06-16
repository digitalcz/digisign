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
use Psr\Http\Message\RequestInterface;
use RuntimeException;

abstract class EndpointTestCase extends TestCase
{
    /** @var Client  */
    private static $httpClient;

    /** @var DigiSign  */
    private static $dgs;

    protected static function dgs(): DigiSign
    {
        return self::$dgs;
    }

    protected function setUp(): void
    {
        self::$httpClient = new Client();
        self::$httpClient->setDefaultResponse(new Response(200, [], '{}'));
        self::$dgs = new DigiSign(
            [
                'credentials' => new TokenCredentials(new Token('token', time())),
                'client' => new DigiSignClient(self::$httpClient),
            ]
        );
    }

    /**
     * @param mixed[] $result
     */
    protected static function addResponse(int $code, array $result): void
    {
        self::$httpClient->addResponse(new Response($code, [], DigiSignClient::jsonEncode($result)));
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
        self::assertLastRequestMethod($method);
        self::assertLastRequestPath($path);
        self::assertLastRequestAuthorizationHeader('Bearer token');

        if ($body !== null) {
            self::assertLastRequestJsonBody($body);
        }
    }

    protected static function assertLastRequestPath(string $path): void
    {
        self::assertLastRequestUri('https://api.digisign.org' . $path);
    }

    protected static function assertLastRequestUri(string $uri): void
    {
        self::assertSame($uri, (string)self::getLastRequest()->getUri());
    }

    protected static function assertLastRequestMethod(string $method): void
    {
        self::assertSame($method, self::getLastRequest()->getMethod());
    }

    protected static function assertLastRequestMethodIsDelete(): void
    {
        self::assertLastRequestMethod('DELETE');
    }

    protected static function assertLastRequestMethodIsGet(): void
    {
        self::assertLastRequestMethod('GET');
    }

    protected static function assertLastRequestMethodIsPut(): void
    {
        self::assertLastRequestMethod('PUT');
    }

    protected static function assertLastRequestMethodIsPost(): void
    {
        self::assertLastRequestMethod('POST');
    }

    protected static function assertLastRequestAuthorizationHeader(string $expected): void
    {
        self::assertLastRequestHeader($expected, 'Authorization');
    }

    protected static function assertLastRequestHeader(string $expected, string $header): void
    {
        self::assertStringStartsWith($expected, self::getLastRequest()->getHeaderLine($header));
    }

    /**
     * @param mixed[] $json
     */
    protected static function assertLastRequestJsonBody(array $json): void
    {
        self::assertLastRequestBody(DigiSignClient::jsonEncode($json));
    }

    protected static function assertLastRequestBody(string $content): void
    {
        self::assertSame($content, (string)self::getLastRequest()->getBody());
    }

    protected static function assertCrudRequests(EndpointInterface $endpoint, string $path): void
    {
        self::assertTrue(method_exists($endpoint, 'list'));
        $endpoint->list(['foo' => 'bar']);
        self::assertLastRequest('GET', "$path?foo=bar");

        self::assertTrue(method_exists($endpoint, 'create'));
        $endpoint->create(['foo' => 'bar']);
        self::assertLastRequest('POST', $path, ['foo' => 'bar']);

        self::assertTrue(method_exists($endpoint, 'get'));
        $endpoint->get('foo');
        self::assertLastRequest('GET', "$path/foo");

        self::assertTrue(method_exists($endpoint, 'update'));
        $endpoint->update('foo', ['foo' => 'bar']);
        self::assertLastRequest('PUT', "$path/foo", ['foo' => 'bar']);

        self::assertTrue(method_exists($endpoint, 'delete'));
        $endpoint->delete('foo');
        self::assertLastRequest('DELETE', "$path/foo");
    }

    protected static function getLastRequest(): RequestInterface
    {
        $lastRequest = self::$httpClient->getLastRequest();

        if ($lastRequest === false) {
            throw new RuntimeException('No last request');
        }

        return $lastRequest;
    }
}
