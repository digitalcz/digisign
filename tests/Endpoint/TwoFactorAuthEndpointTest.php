<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\TwoFactorAuthEndpoint
 */
final class TwoFactorAuthEndpointTest extends EndpointTestCase
{
    public function testConfigureTwoFactorAuth(): void
    {
        self::endpoint()->configure(['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/account/users/foo/2fa', ['foo' => 'bar']);
    }

    public function testDisableTwoFactorAuth(): void
    {
        self::endpoint()->disable();
        self::assertLastRequest('DELETE', '/api/account/users/foo/2fa');
    }

    public function testResetTwoFactorAuth(): void
    {
        self::endpoint()->reset(['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/account/users/foo/2fa/reset', ['foo' => 'bar']);
    }

    protected static function endpoint(): TwoFactorAuthEndpoint
    {
        return self::dgs()->account()->users()->twoFactorAuth('foo');
    }
}
