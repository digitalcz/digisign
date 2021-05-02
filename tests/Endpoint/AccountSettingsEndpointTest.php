<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountSettingsEndpoint
 */
class AccountSettingsEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/account/settings');
    }

    public function testUpdate(): void
    {
        self::endpoint()->update(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/account/settings', ['foo' => 'bar']);
    }

    protected static function endpoint(): AccountSettingsEndpoint
    {
        return self::digiSign()->account()->settings();
    }
}
