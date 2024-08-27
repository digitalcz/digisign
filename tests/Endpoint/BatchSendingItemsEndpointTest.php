<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\BatchSendingsItemsEndpoint
 */
class BatchSendingItemsEndpointTest extends EndpointTestCase
{
    public function testImport(): void
    {
        self::endpoint()->import('bar');
        self::assertLastRequest('POST', "/api/batch-sendings/foo/items/import", ['file' => 'bar']);
    }

    protected static function endpoint(): BatchSendingsItemsEndpoint
    {
        return self::dgs()->batchSendings()->items('foo');
    }
}
