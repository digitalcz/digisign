<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountMeEndpoint
 */
class AccountMeEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/account/me');
    }

    public function testPut(): void
    {
        self::endpoint()->update([]);
        self::assertLastRequest('PUT', '/api/account/me');
    }

    public function testChangePassword(): void
    {
        self::endpoint()->changePassword(['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/account/me/change-password', ['foo' => 'bar']);
    }

    public function testChangePasswordRequest(): void
    {
        self::endpoint()->changePasswordRequest();
        self::assertLastRequest('POST', '/api/account/me/change-password/request');
    }

    public function testVerifyPassword(): void
    {
        self::endpoint()->verifyPassword(['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/account/me/verify-password', ['foo' => 'bar']);
    }

    public function testSignatureImageContent(): void
    {
        self::endpoint()->signatureImageContent();
        self::assertLastRequest('GET', '/api/account/me/signature-image/content');
    }

    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->twoFactorAuth(), '/api/account/me/2fa');
    }

    protected static function endpoint(): AccountMeEndpoint
    {
        return self::dgs()->account()->me();
    }
}
