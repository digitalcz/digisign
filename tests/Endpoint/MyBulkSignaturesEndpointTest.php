<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(MyBulkSignaturesEndpoint::class)]
class MyBulkSignaturesEndpointTest extends EndpointTestCase
{
    public function testListToSign(): void
    {
        self::endpoint()->listToSign(['page' => 3, 'itemsPerPage' => 10]);
        self::assertLastRequest('GET', '/api/my/bulk-signatures/to-sign?page=3&itemsPerPage=10');
    }

    public function testSign(): void
    {
        self::endpoint()->sign('foo');
        self::assertLastRequest('POST', '/api/my/bulk-signatures/foo/sign');
    }

    protected static function endpoint(): MyBulkSignaturesEndpoint
    {
        return self::dgs()->my()->bulkSignatures();
    }
}
