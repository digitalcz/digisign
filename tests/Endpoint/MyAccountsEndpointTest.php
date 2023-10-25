<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\MyAccountsEndpoint
 */
class MyAccountsEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list();
        self::assertLastRequest('GET', '/api/my/accounts');
    }

    public function testCreate(): void
    {
        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', "/api/my/accounts", ['foo' => 'bar']);
    }

    public function testAccept(): void
    {
        self::endpoint()->accept('foo');
        self::assertLastRequest('POST', '/api/my/accounts/foo/accept');
    }

    public function testDecline(): void
    {
        self::endpoint()->decline('foo');
        self::assertLastRequest('POST', '/api/my/accounts/foo/decline');
    }

    public function testSwitch(): void
    {
        self::endpoint()->switch('foo');
        self::assertLastRequest('POST', '/api/my/accounts/foo/switch');
    }

    private static function endpoint(): MyAccountsEndpoint
    {
        return self::dgs()->my()->accounts();
    }
}
