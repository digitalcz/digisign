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

    public function testApprove(): void
    {
        self::endpoint()->approve('foo');
        self::assertLastRequest('POST', '/api/identifications/foo/approve');
    }

    public function testDeny(): void
    {
        self::endpoint()->deny('foo');
        self::assertLastRequest('POST', '/api/identifications/foo/deny');
    }

    protected static function endpoint(): IdentificationsEndpoint
    {
        return self::dgs()->identifications();
    }
}
