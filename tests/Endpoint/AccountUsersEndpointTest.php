<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountUsersEndpoint
 */
class AccountUsersEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/account/users?foo=bar');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/account/users/foo');
    }

    public function testUpdate(): void
    {
        self::endpoint()->update('foo', ['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/account/users/foo', ['foo' => 'bar']);
    }

    public function testActivate(): void
    {
        self::endpoint()->activate('foo');
        self::assertLastRequest('POST', '/api/account/users/foo/activate');
    }

    public function testDeactivate(): void
    {
        self::endpoint()->deactivate('foo');
        self::assertLastRequest('POST', '/api/account/users/foo/deactivate');
    }

    public function testDisinvite(): void
    {
        self::endpoint()->disinvite('foo');
        self::assertLastRequest('POST', '/api/account/users/foo/disinvite');
    }

    public function testInvite(): void
    {
        self::endpoint()->invite(['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/account/users', ['foo' => 'bar']);
    }

    protected static function endpoint(): AccountUsersEndpoint
    {
        return self::digiSign()->account()->users();
    }
}
