<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AccountSmsSendersEndpoint::class)]
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
