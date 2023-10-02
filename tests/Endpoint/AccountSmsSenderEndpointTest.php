<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountSmsSendersEndpoint
 */
class AccountSmsSenderEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list();
        self::assertLastRequest('GET', '/api/account/sms-senders');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/account/sms-senders/foo');
    }

    protected static function endpoint(): AccountSmsSendersEndpoint
    {
        return self::dgs()->account()->smsSenders();
    }
}
