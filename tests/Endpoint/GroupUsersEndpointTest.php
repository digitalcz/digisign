<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\GroupUsersEndpoint
 */
class GroupUsersEndpointTest extends EndpointTestCase
{
    public function testAdd(): void
    {
        self::endpoint()->add(['users' => ['user1', 'user2']]);
        self::assertLastRequest('POST', '/api/account/groups/foo/users', ['users' => ['user1', 'user2']]);
    }

    public function testDelete(): void
    {
        self::endpoint()->delete(['users' => ['user1', 'user2']]);
        self::assertLastRequest('DELETE', '/api/account/groups/foo/users', ['users' => ['user1', 'user2']]);
    }

    protected static function endpoint(): GroupUsersEndpoint
    {
        return self::dgs()->account()->groups()->users('foo');
    }
}
