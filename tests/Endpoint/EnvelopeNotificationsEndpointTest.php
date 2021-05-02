<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeNotificationsEndpoint
 */
class EnvelopeNotificationsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelopes/bar/notifications');
    }

    protected static function endpoint(): EnvelopeNotificationsEndpoint
    {
        return self::digiSign()->envelopes()->notifications('bar');
    }
}
