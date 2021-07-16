<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\MyEndpoint
 */
class MyEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->dashboard(), '/api/my/dashboard');
        self::assertDefaultEndpointPath(self::endpoint()->envelopes(), '/api/my/envelopes');
    }

    private static function endpoint(): MyEndpoint
    {
        return self::dgs()->my();
    }
}
