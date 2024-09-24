<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\BatchSendingItemsEndpoint
 */
class BatchSendingItemsEndpointTest extends EndpointTestCase
{
    public function testImport(): void
    {
        self::endpoint()->import(['file' => 'bar']);
        self::assertLastRequest('POST', "/api/batch-sendings/bar/items/import", ['file' => 'bar']);
    }

    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/batch-sendings/bar/items?foo=bar');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/batch-sendings/bar/items/foo');
    }

    public function testCreate(): void
    {
        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/batch-sendings/bar/items', ['foo' => 'bar']);
    }

    public function testUpdate(): void
    {
        self::endpoint()->update('foo', ['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/batch-sendings/bar/items/foo', ['foo' => 'bar']);
    }

    public function testDelete(): void
    {
        self::endpoint()->delete('foo');
        self::assertLastRequest('DELETE', '/api/batch-sendings/bar/items/foo');
    }

    protected static function endpoint(): BatchSendingItemsEndpoint
    {
        return self::dgs()->batchSendings()->items('bar');
    }
}
