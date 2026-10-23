<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EnvelopeNotificationsEndpoint::class)]
class EnvelopeNotificationsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelopes/bar/notifications');
    }

    protected static function endpoint(): EnvelopeNotificationsEndpoint
    {
        return self::dgs()->envelopes()->notifications('bar');
    }
}
