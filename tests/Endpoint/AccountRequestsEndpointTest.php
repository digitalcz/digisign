<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountRequestsEndpoint
 */
class AccountRequestsEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/account/requests?foo=bar');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/account/requests/foo');
    }

    protected static function endpoint(): AccountRequestsEndpoint
    {
        return self::digiSign()->account()->requests();
    }
}
