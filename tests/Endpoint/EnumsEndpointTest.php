<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnumsEndpoint
 */
class EnumsEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/enums/foo');
    }

    protected static function endpoint(): EnumsEndpoint
    {
        return self::dgs()->enums();
    }
}
