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

    public function testNormalization(): void
    {
        $resource = new ListResource(DummyResource::LIST_EXAMPLE, DummyResource::class);
        $array = $resource->toArray();

        self::assertEquals(DummyResource::LIST_EXAMPLE, $array);
    }
}
