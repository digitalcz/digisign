<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(BulkSignatureEndpoint::class)]
final class BulkSignatureEndpointTest extends EndpointTestCase
{
    public function testCreate(): void
    {
        self::endpoint()->create(['name' => 'John']);
        self::assertLastRequest('POST', '/api/bulk-signatures');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/bulk-signatures/foo');
    }

    public function testList(): void
    {
        self::endpoint()->list();
        self::assertLastRequest('GET', '/api/bulk-signatures');
    }

    public function testUpdate(): void
    {
        self::endpoint()->update('foo', ['name' => 'Jane']);
        self::assertLastRequest('PUT', '/api/bulk-signatures/foo');
    }

    public function testSend(): void
    {
        self::endpoint()->send('foo');
        self::assertLastRequest('POST', '/api/bulk-signatures/foo/send');
    }

    public function testResend(): void
    {
        self::endpoint()->resend('foo');
        self::assertLastRequest('POST', '/api/bulk-signatures/foo/resend');
    }

    protected static function endpoint(): BulkSignatureEndpoint
    {
        return self::dgs()->bulkSignature();
    }
}
