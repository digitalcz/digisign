<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EnvelopeTemplateNotificationsEndpoint::class)]
class EnvelopeTemplateNotificationsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelope-templates/bar/notifications');
    }

    protected static function endpoint(): EnvelopeTemplateNotificationsEndpoint
    {
        return self::dgs()->envelopeTemplates()->notifications('bar');
    }
}
