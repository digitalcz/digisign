<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\BulkSignatureEndpoint
 */
final class BulkSignatureEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/bulk-signatures/foo');
    }

    protected static function endpoint(): BulkSignatureEndpoint
    {
        return self::dgs()->bulkSignature();
    }
}
