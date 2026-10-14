<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(BillingProfileEndpoint::class)]
class BillingProfileEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/account/billing-profile');
    }

    public function testUpdate(): void
    {
        self::endpoint()->update(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/account/billing-profile', ['foo' => 'bar']);
    }

    protected static function endpoint(): BillingProfileEndpoint
    {
        return self::dgs()->account()->billingProfile();
    }
}
