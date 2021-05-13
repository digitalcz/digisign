<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTimeInterface;
use DigitalCz\DigiSign\Exception\RuntimeException;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Resource\BaseResource
 */
class BaseResourceTest extends TestCase
{
    public function testHydration(): void
    {
        $resource = new DummyResource(DummyResource::EXAMPLE);
        self::assertTrue($resource->bool);
        self::assertSame('foo', $resource->string);
        self::assertNull($resource->nullable);
        self::assertSame(123, $resource->integer);
        self::assertSame(1.55, $resource->float);
        self::assertSame('bar', $resource->resource->string);
        self::assertEquals('2021-01-01T01:01:01+00:00', $resource->dateTime->format(DateTimeInterface::ATOM));
        self::assertCount(2, $resource->collection);
        self::assertInstanceOf(DummyResource::class, $resource->collection[0]);
        self::assertSame('moo', $resource->collection[0]->string);
        self::assertInstanceOf(DummyResource::class, $resource->collection[1]);
        self::assertSame('baz', $resource->collection[1]->string);
        self::assertObjectHasAttribute('unmapped', $resource);
        self::assertSame('goo', $resource->unmapped);
        self::assertSame('#foobar', $resource->self());
        self::assertSame(DummyResource::ID, $resource->id());
    }

    public function testNormalization(): void
    {
        $resource = new DummyResource(DummyResource::EXAMPLE);
        self::assertEquals(
            [
                'id' => DummyResource::ID,
                'bool' => true,
                'string' => 'foo',
                'nullable' => null,
                'integer' => 123,
                'float' => 1.55,
                'resource' => [
                    'string' => 'bar',
                ],
                'dateTime' => '2021-01-01T01:01:01+00:00',
                'collection' => [
                    ['string' => 'moo'],
                    ['string' => 'baz'],
                ],
                'unmapped' => 'goo',
            ],
            $resource->toArray(),
        );
    }

    public function testGetResult(): void
    {
        $resource = new DummyResource(DummyResource::EXAMPLE);
        self::assertEquals(DummyResource::EXAMPLE, $resource->getResult());
    }

    public function testGetResponse(): void
    {
        $resource = new DummyResource(DummyResource::EXAMPLE);
        $response = new Response();
        $resource->setResponse($response);
        self::assertSame($response, $resource->getResponse());
    }

    public function testGetResponseException(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Only resource returned from client has API response set');
        $resource = new DummyResource(DummyResource::EXAMPLE);
        $resource->getResponse();
    }
}
