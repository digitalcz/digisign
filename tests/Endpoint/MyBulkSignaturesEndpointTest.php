<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\MyBulkSignaturesEndpoint
 */
class MyBulkSignaturesEndpointTest extends EndpointTestCase
{
    public function testListToSign(): void
    {
        self::endpoint()->listToSign(['page' => 3, 'itemsPerPage' => 10]);
        self::assertLastRequest('GET', '/api/my/bulk-signatures/to-sign?page=3&itemsPerPage=10');
    }

    protected static function endpoint(): MyBulkSignaturesEndpoint
    {
        return self::dgs()->my()->bulkSignatures();
    }
}
