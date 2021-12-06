<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountCertificatesEndpoint
 */
class AccountCertificatesEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['status' => 'valid']);
        self::assertLastRequest('GET', '/api/account/certificates?status=valid');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/account/certificates/foo');
    }

    public function testCreate(): void
    {
        self::endpoint()->create(['storage' => 'azure_key_vault']);
        self::assertLastRequest('POST', '/api/account/certificates', ['storage' => 'azure_key_vault']);
    }

    public function testReload(): void
    {
        self::endpoint()->reload('foo');
        self::assertLastRequest('POST', '/api/account/certificates/foo/reload');
    }

    protected static function endpoint(): AccountCertificatesEndpoint
    {
        return self::dgs()->account()->certificates();
    }
}
