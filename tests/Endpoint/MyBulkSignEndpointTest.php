<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(MyBulkSignEndpoint::class)]
class MyBulkSignEndpointTest extends EndpointTestCase
{
    public function testEnvelopes(): void
    {
        self::endpoint()->envelopes(['page' => 3, 'itemsPerPage' => 10]);
        self::assertLastRequest('GET', '/api/my/bulk-sign/envelopes?page=3&itemsPerPage=10');
    }

    public function testBulkSignatures(): void
    {
        self::endpoint()->bulkSignatures(['page' => 3, 'itemsPerPage' => 10]);
        self::assertLastRequest('GET', '/api/my/bulk-sign/bulk-signatures?page=3&itemsPerPage=10');
    }

    protected static function endpoint(): MyBulkSignEndpoint
    {
        return self::dgs()->my()->bulkSign();
    }
}
