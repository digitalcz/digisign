<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(BatchSendingsEndpoint::class)]
class BatchSendingEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->items('foo'), '/api/batch-sendings/foo/items');
    }

    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/batch-sendings');
    }

    public function testSend(): void
    {
        self::endpoint()->send('foo');
        self::assertLastRequest('POST', "/api/batch-sendings/foo/send");
    }

    public function testStats(): void
    {
        self::endpoint()->stats('foo');
        self::assertLastRequest('GET', "/api/batch-sendings/foo/stats");
    }

    public function testBulkSignatureRecipients(): void
    {
        self::endpoint()->bulkSignatureRecipients('foo');
        self::assertLastRequest('GET', "/api/batch-sendings/foo/bulk-signature-recipients");
    }

    protected static function endpoint(): BatchSendingsEndpoint
    {
        return self::dgs()->batchSendings();
    }
}
