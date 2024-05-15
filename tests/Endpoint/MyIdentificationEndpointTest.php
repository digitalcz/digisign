<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\MyIdentificationsEndpoint
 */
class MyIdentificationEndpointTest extends EndpointTestCase
{
    public function testInfo(): void
    {
        self::endpoint()->info('foo');
        self::assertLastRequest('GET', '/api/my/identifications/foo/info');
    }

    protected static function endpoint(): MyIdentificationsEndpoint
    {
        return self::dgs()->my()->identifications();
    }
}
