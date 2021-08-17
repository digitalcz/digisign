<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\MyContactsEndpoint
 */
final class MyContactsEndpointTest extends EndpointTestCase
{
    public function testSuggest(): void
    {
        self::endpoint()->suggest('foo', 30);
        self::assertLastRequest('GET', '/api/my/contacts/suggest?search=foo&limit=30');
    }

    protected static function endpoint(): MyContactsEndpoint
    {
        return self::dgs()->contacts();
    }
}
