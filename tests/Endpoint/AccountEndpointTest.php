<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountEndpoint
 */
class AccountEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->me(), '/api/account/me');
        self::assertDefaultEndpointPath(self::endpoint()->settings(), '/api/account/settings');
        self::assertDefaultEndpointPath(self::endpoint()->requests(), '/api/account/requests');
        self::assertDefaultEndpointPath(self::endpoint()->envelopeTemplate(), '/api/account/envelope-template');
        self::assertDefaultEndpointPath(self::endpoint()->apiKeys(), '/api/account/api-keys');
        self::assertDefaultEndpointPath(self::endpoint()->users(), '/api/account/users');
    }

    public function testGet(): void
    {
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/account');
    }

    public function testSmsLog(): void
    {
        self::endpoint()->smsLog(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/account/sms-log?foo=bar');
    }

    public function testStatistics(): void
    {
        self::endpoint()->statistics(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/account/statistics?foo=bar');
    }

    public function testBilling(): void
    {
        self::endpoint()->billing();
        self::assertLastRequest('GET', '/api/account/billing');
    }

    protected static function endpoint(): AccountEndpoint
    {
        return self::dgs()->account();
    }
}
