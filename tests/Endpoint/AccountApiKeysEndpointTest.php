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
        self::$digiSign->account()->apiKeys()->list(['status' => 'active']);
        self::assertLastRequest('GET', '/api/account/api-keys?status=active');
    }

    public function testGet(): void
    {
        self::$digiSign->account()->apiKeys()->get('foo');
        self::assertLastRequest('GET', '/api/account/api-keys/foo');
    }

    public function testCreate(): void
    {
        self::$digiSign->account()->apiKeys()->create(['status' => 'active']);
        self::assertLastRequest('POST', '/api/account/api-keys', ['status' => 'active']);
    }

    public function testUpdate(): void
    {
        self::$digiSign->account()->apiKeys()->update('foo', ['status' => 'active']);
        self::assertLastRequest('PUT', '/api/account/api-keys/foo', ['status' => 'active']);
    }

    public function testActivate(): void
    {
        self::$digiSign->account()->apiKeys()->activate('foo');
        self::assertLastRequest('POST', '/api/account/api-keys/foo/activate');
    }

    public function testDeactivate(): void
    {
        self::$digiSign->account()->apiKeys()->deactivate('foo');
        self::assertLastRequest('POST', '/api/account/api-keys/foo/deactivate');
    }
}
