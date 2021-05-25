<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use DateTime;
use DigitalCz\DigiSign\Exception\BadRequestException;
use DigitalCz\DigiSign\Exception\ClientException;
use DigitalCz\DigiSign\Exception\NotFoundException;
use DigitalCz\DigiSign\Exception\RuntimeException;
use DigitalCz\DigiSign\Exception\ServerException;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\DummyResource;
use DigitalCz\DigiSign\Stream\FileStream;
use Http\Mock\Client;
use InvalidArgumentException;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;
use stdClass;

/**
 * @covers \DigitalCz\DigiSign\DigiSignClient
 */
class DigiSignClientTest extends TestCase
{
    public function testParseResponse(): void
    {
        $response = new Response(200, [], '{"foo": "bar"}');
        $result = DigiSignClient::parseResponse($response);

        self::assertSame(['foo' => 'bar'], $result);
    }

    public function testParseNoContentResponse(): void
    {
        $response = new Response(204, [], null);
        $result = DigiSignClient::parseResponse($response);

        self::assertNull($result);
    }

    public function testParseEmptyResponseException(): void
    {
        $response = new Response(200, [], null);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Empty response body');
        DigiSignClient::parseResponse($response);
    }

    public function testUnableToParseResponseException(): void
    {
        $response = new Response(200, [], '{"a');

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to parse response');
        DigiSignClient::parseResponse($response);
    }

    public function testRequestGet(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request('POST', 'https://example.com/api/test');

        $lastRequest = $httpClient->getLastRequest();
        self::assertSame('POST', $lastRequest->getMethod());
        self::assertSame('https://example.com/api/test', (string)$lastRequest->getUri());
    }

    public function testRequestWithUriParams(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request(
            'GET',
            'https://example.com/api/{foo}/{bar}',
            [
                'foo' => 'baz', // URI param is string
                'bar' => new DummyResource(DummyResource::EXAMPLE), // URI param is resource
            ],
        );

        self::assertSame(
            'https://example.com/api/baz/' . DummyResource::ID,
            (string)$httpClient->getLastRequest()->getUri(),
        );
    }

    public function testRequestWithMissingUriParam(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Cannot resolve uri parameter bar');
        $client->request('GET', 'https://example.com/api/{foo}/{bar}', ['foo' => 'baz']);
    }

    public function testRequestWithQuery(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request(
            'GET',
            'https://example.com/api',
            ['query' => ['foo' => 'bar', 'moo' => ['lt' => 10, 'eq' => 55]]],
        );

        self::assertSame(
            'https://example.com/api?foo=bar&moo%5Blt%5D=10&moo%5Beq%5D=55',
            (string)$httpClient->getLastRequest()->getUri(),
        );
    }

    public function testRequestWithInvalidHeaders(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "headers" option');
        $client->request('GET', 'https://example.com/api', ['headers' => 'fooo']);
    }

    public function testRequestWithUserAgent(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request('GET', 'https://example.com/api', ['user-agent' => 'foobar']);

        self::assertSame('foobar', $httpClient->getLastRequest()->getHeaderLine('User-Agent'));
    }

    public function testRequestWithBearerAuth(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request('GET', 'https://example.com/api', ['auth_bearer' => 'foobar']);

        self::assertSame('Bearer foobar', $httpClient->getLastRequest()->getHeaderLine('Authorization'));
    }

    public function testRequestWithInvalidBearerAuth(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "auth_bearer" option');
        $client->request('GET', 'https://example.com/api', ['auth_bearer' => new stdClass()]);
    }

    public function testRequestWithBasicAuth(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request('GET', 'https://example.com/api', ['auth_basic' => ['user', 'pass']]);

        self::assertSame('Basic dXNlcjpwYXNz', $httpClient->getLastRequest()->getHeaderLine('Authorization'));
    }

    public function testRequestWithInvalidBasicAuth(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "auth_basic" option');
        $client->request('GET', 'https://example.com/api', ['auth_basic' => new stdClass()]);
    }

    public function testRequestWithInvalidMultipart(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "multipart" option');
        $client->request('GET', 'https://example.com/api', ['multipart' => 'foo']);
    }

    public function testRequestWithMultipart(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request('GET', 'https://example.com/api', ['multipart' => ['foo' => 'bar']]);

        $lastRequest = $httpClient->getLastRequest();
        $contentType = $lastRequest->getHeaderLine('Content-Type');
        $boundary = trim(substr($contentType, 30), '"');
        self::assertStringStartsWith("multipart/form-data; boundary=\"$boundary\"", $contentType);
        self::assertSame(
            "--$boundary\r\nContent-Disposition: form-data; name=\"foo\"\r\nContent-Length: 3\r\n\r\nbar\r\n--$boundary--\r\n",
            (string)$lastRequest->getBody(),
        );
    }

    public function testRequestWithMultipartStream(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request(
            'GET',
            'https://example.com/api',
            ['multipart' => ['file' => FileStream::open(__DIR__ . '/dummy.pdf')]],
        );

        $lastRequest = $httpClient->getLastRequest();
        $contentType = $lastRequest->getHeaderLine('Content-Type');
        $boundary = trim(substr($contentType, 30), '"');
        self::assertStringStartsWith("multipart/form-data; boundary=\"$boundary\"", $contentType);
        self::assertStringStartsWith(
            "--$boundary\r\nContent-Disposition: form-data; name=\"file\"; filename=\"dummy.pdf\"\r\nContent-Length: 13264\r\nContent-Type: application/pdf",
            (string)$lastRequest->getBody(),
        );
    }

    public function testRequestWithJson(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request('GET', 'https://example.com/api', ['json' => ['foo' => 'bar']]);

        $lastRequest = $httpClient->getLastRequest();
        self::assertSame('application/json', $lastRequest->getHeaderLine('Content-Type'));
        self::assertSame('{"foo":"bar"}', (string)$lastRequest->getBody());
    }

    public function testRequestWithInvalidJson(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "json" option');
        $client->request('GET', 'https://example.com/api', ['json' => false]);
    }

    public function testRequestWithInvalidJsonNotEncodable(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "json" option');
        $client->request('GET', 'https://example.com/api', ['json' => ['foo' => INF]]);
    }

    public function testRequestWithResourceBody(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $body = fopen('data://text/plain,foobar', 'rb');
        $client->request('GET', 'https://example.com/api', ['body' => $body]);

        $lastRequest = $httpClient->getLastRequest();
        self::assertSame('foobar', (string)$lastRequest->getBody());
    }

    public function testRequestWithInvalidBody(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $this->expectException(InvalidArgumentException::class);
        $this->expectExceptionMessage('Invalid value for "body" option');
        $client->request('GET', 'https://example.com/api', ['body' => new stdClass()]);
    }

    public function testRequestServerException(): void
    {
        $response = new Response(500);

        $httpClient = new Client();
        $httpClient->addResponse($response);

        $client = new DigiSignClient($httpClient);

        $this->expectException(ServerException::class);
        $this->expectExceptionMessage('500 Internal Server Error');

        $client->request('GET', 'https://example.com/api');
    }

    public function testRequestBadRequestException(): void
    {
        $response = new Response(400);

        $httpClient = new Client();
        $httpClient->addResponse($response);

        $client = new DigiSignClient($httpClient);

        $this->expectException(BadRequestException::class);
        $this->expectExceptionMessage('400 Bad Request');

        $client->request('GET', 'https://example.com/api');
    }

    public function testRequestNotFoundException(): void
    {
        $response = new Response(404);

        $httpClient = new Client();
        $httpClient->addResponse($response);

        $client = new DigiSignClient($httpClient);

        $this->expectException(NotFoundException::class);
        $this->expectExceptionMessage('404 Not Found');

        $client->request('GET', 'https://example.com/api');
    }

    public function testRequestClientException(): void
    {
        $response = new Response(401);

        $httpClient = new Client();
        $httpClient->addResponse($response);

        $client = new DigiSignClient($httpClient);

        $this->expectException(ClientException::class);
        $this->expectExceptionMessage('401 Unauthorized');

        $client->request('GET', 'https://example.com/api');
    }

    public function testNormalizeJson(): void
    {
        $httpClient = new Client();
        $client = new DigiSignClient($httpClient);

        $client->request('GET', 'https://example.com/api', [
            'json' => [
                'datetime' => new DateTime('2020-01-01 13:30+02:00'),
                'resource' => new BaseResource(['_links' => ['self' => 'foo-bar']]),
                'nested' => [
                    'foo' => 'bar',
                    'resource' => new BaseResource(['_links' => ['self' => 'moo-baz']]),
                ],
            ],
        ]);

        $lastRequest = $httpClient->getLastRequest();
        self::assertSame('application/json', $lastRequest->getHeaderLine('Content-Type'));
        $expectedJson = '{"datetime":"2020-01-01T13:30:00+02:00","resource":"foo-bar","nested":{"foo":"bar","resource":"moo-baz"}}';
        self::assertSame($expectedJson, (string)$lastRequest->getBody());
    }
}
