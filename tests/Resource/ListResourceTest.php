<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Resource\ListResource
 */
class ListResourceTest extends TestCase
{
    public function testHydration(): void
    {
        $resource = new ListResource(DummyResource::LIST_EXAMPLE, DummyResource::class);
        self::assertSame(3, $resource->count);
        self::assertSame(1, $resource->page);
        self::assertSame(10, $resource->itemsPerPage);
        self::assertSame(1, $resource->lastPage);
        self::assertCount(3, $resource->items);
        self::assertSame('foo', $resource->items[0]->string);
        self::assertSame('foo', $resource->items[1]->string);
        self::assertSame('foo', $resource->items[2]->string);
    }

    public function testNormalization(): void // phpcs:ignore
    {
        $resource = new ListResource(DummyResource::LIST_EXAMPLE, DummyResource::class);
        $array = $resource->toArray();

        $expectedItem = [
            'id' => DummyResource::ID,
            'bool' => true,
            'string' => 'foo',
            'nullable' => null,
            'integer' => 123,
            'float' => 1.55,
            'resource' => [
                'string' => 'bar',
                'id' => null,
                'bool' => null,
                'nullable' => null,
                'integer' => null,
                'float' => null,
                'resource' => null,
                'dateTime' => null,
                'dateTimeNullable' => null,
                'collection' => null,
            ],
            'dateTime' => '2021-01-01T01:01:01+00:00',
            'dateTimeNullable' => '2021-01-01T01:01:01+00:00',
            'collection' => [
                [
                    'string' => 'moo',
                    'id' => null,
                    'bool' => null,
                    'nullable' => null,
                    'integer' => null,
                    'float' => null,
                    'resource' => null,
                    'dateTime' => null,
                    'dateTimeNullable' => null,
                    'collection' => null,
                ],
                [
                    'string' => 'baz',
                    'id' => null,
                    'bool' => null,
                    'nullable' => null,
                    'integer' => null,
                    'float' => null,
                    'resource' => null,
                    'dateTime' => null,
                    'dateTimeNullable' => null,
                    'collection' => null,
                ],
            ],
            'unmapped' => 'goo',
            '_links' => ['self' => '#foobar'],
        ];
        $expected = [
            'items' => [$expectedItem, $expectedItem, $expectedItem],
            'count' => 3,
            'page' => 1,
            'itemsPerPage' => 10,
            'lastPage' => 1,
            'nextPage' => null,
            'prevPage' => null,
        ];

        self::assertEquals($expected, $array);
    }
}
