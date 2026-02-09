<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\BillingProfileEndpoint
 */
class BillingProfileEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/account/billing-profile/foo');
    }

    public function testUpdate(): void
    {
        self::endpoint()->update('foo', ['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/account/billing-profile/foo', ['foo' => 'bar']);
    }

    protected static function endpoint(): BillingProfileEndpoint
    {
        return self::dgs()->account()->billingProfile();
    }
}
