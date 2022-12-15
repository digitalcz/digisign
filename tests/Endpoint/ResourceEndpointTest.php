<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSignClient;
use DigitalCz\DigiSign\Exception\EmptyResultException;
use DigitalCz\DigiSign\Exception\ResponseException;
use DigitalCz\DigiSign\Resource\Collection;
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
                self::equalTo(['option' => 'bar'])
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
                self::equalTo(['option' => 'bar'])
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $streamResponse = $endpoint->stream('GET', '/path', ['option' => 'bar']);

        self::assertSame($expectedResponse, $streamResponse->getResponse());
    }

    public function testCreateRequest(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::EXAMPLE));

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('POST'),
                self::equalTo('/dummy'),
                self::equalTo(['json' => DummyResource::EXAMPLE])
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $resource = $endpoint->create(DummyResource::EXAMPLE);
        self::assertSame(DummyResource::EXAMPLE, $resource->getResult());
    }

    public function testUpdateRequest(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::EXAMPLE));

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('PUT'),
                self::equalTo('/dummy/{id}'),
                self::equalTo(['id' => 'foo', 'json' => DummyResource::EXAMPLE])
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
                self::equalTo(['id' => 'foo'])
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $endpoint->delete('foo');
    }

    public function testGetRequest(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::EXAMPLE));

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('GET'),
                self::equalTo('/dummy/{id}'),
                self::equalTo(['id' => DummyResource::ID])
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $resource = $endpoint->get(DummyResource::ID);
        self::assertSame(DummyResource::EXAMPLE, $resource->getResult());
    }

    public function testPatchRequest(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::EXAMPLE));

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('PATCH'),
                self::equalTo('/dummy')
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $resource = $endpoint->patch();
        self::assertSame(DummyResource::EXAMPLE, $resource->getResult());
    }

    public function testEmptyResultException(): void
    {
        // Response has no_content, but endpoint expects resource
        $expectedResponse = new Response(204);

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('GET'),
                self::equalTo('/dummy/{id}'),
                self::equalTo(['id' => DummyResource::ID])
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);

        $this->expectException(EmptyResultException::class);
        $endpoint->get(DummyResource::ID);
    }

    public function testListRequest(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::LIST_EXAMPLE));

        $parent = $this->createMock(EndpointInterface::class);
        $parent->expects(self::once())
            ->method('request')
            ->with(
                self::equalTo('GET'),
                self::equalTo('/dummy'),
                self::equalTo(['query' => ['foo' => 'bar']])
            )->willReturn($expectedResponse);

        $endpoint = new DummyEndpoint($parent);
        $resource = $endpoint->list(['foo' => 'bar']);
        self::assertSame(DummyResource::LIST_EXAMPLE, $resource->getResult());
    }

    public function testCreateCollectionResource(): void
    {
        $expectedResponse = new Response(200, [], DigiSignClient::jsonEncode(DummyResource::COLLECTION_EXAMPLE));

        $parent = $this->createMock(EndpointInterface::class);
        $endpoint = new DummyEndpoint($parent);
        /** @var Collection<DummyResource> $resource */
        $resource = $endpoint->collection($expectedResponse);
        self::assertSame(DummyResource::COLLECTION_EXAMPLE, $resource->toArray());
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
