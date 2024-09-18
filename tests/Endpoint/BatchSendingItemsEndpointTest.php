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
        self::assertLastRequest('POST', "/api/batch-sendings/foo/items/import", ['file' => 'bar']);
    }

    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/batch-sendings/foo/items');
    }

    protected static function endpoint(): BatchSendingItemsEndpoint
    {
        return self::dgs()->batchSendings()->items('foo');
    }
}
