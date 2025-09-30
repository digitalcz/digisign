<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\GroupsEndpoint
 */
class GroupsEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/account/groups?foo=bar');
    }

    public function testCreate(): void
    {
        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/account/groups', ['foo' => 'bar']);
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/account/groups/foo');
    }

    public function testUpdate(): void
    {
        self::endpoint()->update('foo', ['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/account/groups/foo', ['foo' => 'bar']);
    }

    public function testDelete(): void
    {
        self::endpoint()->delete('foo');
        self::assertLastRequest('DELETE', '/api/account/groups/foo');
    }

    protected static function endpoint(): GroupsEndpoint
    {
        return self::dgs()->account()->groups();
    }
}
