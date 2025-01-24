<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\MultiSignEndpoint
 */
final class MultiSignEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/multi-signs/foo');
    }

    protected static function endpoint(): MultiSignEndpoint
    {
        return self::dgs()->multiSign();
    }
}
