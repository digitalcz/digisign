<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountMeTwoFactorAuthEndpoint
 */
final class AccountMeTwoFactorAuthEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/account/me/2fa');
    }

    public function testConfigure(): void
    {
        self::endpoint()->configure(['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/account/me/2fa', ['foo' => 'bar']);
    }

    public function testDisable(): void
    {
        self::endpoint()->disable();
        self::assertLastRequest('DELETE', '/api/account/me/2fa');
    }

    protected static function endpoint(): AccountMeTwoFactorAuthEndpoint
    {
        return self::dgs()->account()->me()->twoFactorAuth();
    }
}
