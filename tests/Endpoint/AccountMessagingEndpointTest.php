<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountMessagingEndpoint
 */
class AccountMessagingEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/account/messaging');
    }

    public function testUpdate(): void
    {
        self::endpoint()->update(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/account/messaging', ['foo' => 'bar']);
    }

    protected static function endpoint(): AccountMessagingEndpoint
    {
        return self::dgs()->account()->messaging();
    }
}
