<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountSecurityEndpoint
 */
class AccountSecurityEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/account/security');
    }

    public function testUpdate(): void
    {
        self::endpoint()->update(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/account/security', ['foo' => 'bar']);
    }

    protected static function endpoint(): AccountSecurityEndpoint
    {
        return self::dgs()->account()->security();
    }
}
