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
        self::assertDefaultEndpointPath(self::$digiSign->account()->me(), '/api/account/me');
        self::assertDefaultEndpointPath(self::$digiSign->account()->settings(), '/api/account/settings');
        self::assertDefaultEndpointPath(self::$digiSign->account()->requests(), '/api/account/requests');
        self::assertDefaultEndpointPath(
            self::$digiSign->account()->envelopeTemplate(),
            '/api/account/envelope-template',
        );
        self::assertDefaultEndpointPath(self::$digiSign->account()->apiKeys(), '/api/account/api-keys');
        self::assertDefaultEndpointPath(self::$digiSign->account()->users(), '/api/account/users');
    }

    public function testGet(): void
    {
        self::$digiSign->account()->get();
        self::assertLastRequest('GET', '/api/account');
    }

    public function testSmsLog(): void
    {
        self::$digiSign->account()->smsLog(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/account/sms-log?foo=bar');
    }

    public function testStatistics(): void
    {
        self::$digiSign->account()->statistics(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/account/statistics?foo=bar');
    }

    public function testBilling(): void
    {
        self::$digiSign->account()->billing();
        self::assertLastRequest('GET', '/api/account/billing');
    }
}
