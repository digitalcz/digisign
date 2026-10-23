<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(EnumsEndpoint::class)]
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
