<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountApiKeysEndpoint
 */
class AccountApiKeysEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['status' => 'active']);
        self::assertLastRequest('GET', '/api/account/api-keys?status=active');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/account/api-keys/foo');
    }

    public function testCreate(): void
    {
        self::endpoint()->create(['status' => 'active']);
        self::assertLastRequest('POST', '/api/account/api-keys', ['status' => 'active']);
    }

    public function testUpdate(): void
    {
        self::endpoint()->update('foo', ['status' => 'active']);
        self::assertLastRequest('PUT', '/api/account/api-keys/foo', ['status' => 'active']);
    }

    public function testActivate(): void
    {
        self::endpoint()->activate('foo');
        self::assertLastRequest('POST', '/api/account/api-keys/foo/activate');
    }

    public function testDeactivate(): void
    {
        self::endpoint()->deactivate('foo');
        self::assertLastRequest('POST', '/api/account/api-keys/foo/deactivate');
    }

    protected static function endpoint(): AccountApiKeysEndpoint
    {
        return self::digiSign()->account()->apiKeys();
    }
}
