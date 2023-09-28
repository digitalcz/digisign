<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountSmsSendersEndpoint
 */
class AccountSmsSenderEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/account/sms-sender');
    }

    protected static function endpoint(): AccountSmsSendersEndpoint
    {
        return self::dgs()->account()->smsSenders();
    }
}
