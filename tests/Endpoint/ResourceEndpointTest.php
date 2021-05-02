<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Exception\ResponseException;
use DigitalCz\DigiSign\Resource\DummyResource;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\ResourceEndpoint
 */
class ResourceEndpointTest extends TestCase
{
    public function testRequest(): void
    {
        $expectedResponse = new Response(204);

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('GET'),
                self::equalTo('/dummy/path'),
                self::equalTo(['option' => 'bar']),
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $response = $endpoint->request('GET', '/path', ['option' => 'bar']);
        self::assertSame($expectedResponse, $response);
    }

    public function testStream(): void
    {
        $expectedResponse = new Response(204);

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('GET'),
                self::equalTo('/dummy/path'),
                self::equalTo(['option' => 'bar']),
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $streamResponse = $endpoint->stream('GET', '/path', ['option' => 'bar']);

        self::assertSame($expectedResponse, $streamResponse->getResponse());
    }

    public function testCreateRequest(): void
    {
        $expectedResponse = new Response(200, [], json_encode(DummyResource::EXAMPLE, JSON_THROW_ON_ERROR));

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('POST'),
                self::equalTo('/dummy'),
                self::equalTo(['json' => DummyResource::EXAMPLE]),
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $resource = $endpoint->create(DummyResource::EXAMPLE);
        self::assertSame(DummyResource::EXAMPLE, $resource->getResult());
    }

    public function testUpdateRequest(): void
    {
        $expectedResponse = new Response(200, [], json_encode(DummyResource::EXAMPLE, JSON_THROW_ON_ERROR));

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('PUT'),
                self::equalTo('/dummy/{id}'),
                self::equalTo(['id' => 'foo', 'json' => DummyResource::EXAMPLE]),
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $resource = $endpoint->update('foo', DummyResource::EXAMPLE);
        self::assertSame(DummyResource::EXAMPLE, $resource->getResult());
    }

    public function testDeleteRequest(): void
    {
        $expectedResponse = new Response(204);

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('DELETE'),
                self::equalTo('/dummy/{id}'),
                self::equalTo(['id' => 'foo']),
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $endpoint->delete('foo');
    }

    public function testGetRequest(): void
    {
        $expectedResponse = new Response(200, [], json_encode(DummyResource::EXAMPLE, JSON_THROW_ON_ERROR));

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('GET'),
                self::equalTo('/dummy/{id}'),
                self::equalTo(['id' => DummyResource::ID]),
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $resource = $endpoint->get(DummyResource::ID);
        self::assertSame(DummyResource::EXAMPLE, $resource->getResult());
    }

    public function testListRequest(): void
    {
        $expectedResponse = new Response(200, [], json_encode(DummyResource::LIST_EXAMPLE, JSON_THROW_ON_ERROR));

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('GET'),
                self::equalTo('/dummy'),
                self::equalTo(['query' => ['foo' => 'bar']]),
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $resource = $endpoint->list(['foo' => 'bar']);
        self::assertSame(DummyResource::LIST_EXAMPLE, $resource->getResult());
    }

    public function testResponseExceptionEmptyBody(): void
    {
        $expectedResponse = new Response(200);

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->willReturn($expectedResponse);

        $this->expectException(ResponseException::class);
        $this->expectExceptionMessage('Empty response body');

        $endpoint = new DummyEndpoint($parent);
        $endpoint->get('foo');
    }

    public function testResponseExceptionUnableToParse(): void
    {
        $expectedResponse = new Response(200, [], '{"foo":'); // invalid json

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->willReturn($expectedResponse);

        $this->expectException(ResponseException::class);
        $this->expectExceptionMessage('Unable to parse response');

        $endpoint = new DummyEndpoint($parent);
        $endpoint->get('foo');
    }
}
