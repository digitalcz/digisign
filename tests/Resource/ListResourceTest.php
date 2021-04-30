<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Resource\ListResource
 */
class ListResourceTest extends TestCase
{
    /** @var mixed[] */
    private static array $result = [
        'items' => [
            ['string' => 'foo'],
            ['string' => 'bar'],
            ['string' => 'baz'],
        ],
        'count' => 3,
        'page' => 1,
        'itemsPerPage' => 10,
        'lastPage' => 1,
    ];

    public function testHydration(): void
    {
        $resource = new ListResource(self::$result, DummyResource::class);
        self::assertSame(3, $resource->count);
        self::assertSame(1, $resource->page);
        self::assertSame(10, $resource->itemsPerPage);
        self::assertSame(1, $resource->lastPage);
        self::assertCount(3, $resource->items);
        self::assertSame('foo', $resource->items[0]->string);
        self::assertSame('bar', $resource->items[1]->string);
        self::assertSame('baz', $resource->items[2]->string);
    }

    public function testNormalization(): void
    {
        $resource = new ListResource(self::$result, DummyResource::class);
        self::assertEquals(
            [
                'items' => [
                    ['string' => 'foo', 'nullable' => null],
                    ['string' => 'bar', 'nullable' => null],
                    ['string' => 'baz', 'nullable' => null],
                ],
                'count' => 3,
                'page' => 1,
                'itemsPerPage' => 10,
                'lastPage' => 1,
            ],
            $resource->toArray(),
        );
    }
}
