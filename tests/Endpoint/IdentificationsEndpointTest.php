<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\IdentificationsEndpoint
 */
class IdentificationsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/identifications');
    }

    protected static function endpoint(): IdentificationsEndpoint
    {
        return self::dgs()->identifications();
    }
}
