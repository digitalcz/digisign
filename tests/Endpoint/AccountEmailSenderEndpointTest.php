<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountEmailSendersEndpoint
 */
class AccountEmailSenderEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list();
        self::assertLastRequest('GET', '/api/account/email-senders');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/account/email-senders/foo');
    }

    protected static function endpoint(): AccountEmailSendersEndpoint
    {
        return self::dgs()->account()->emailSenders();
    }
}
