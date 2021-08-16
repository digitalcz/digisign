<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\ContactsEndpoint
 */
final class ContactsEndpointTest extends EndpointTestCase
{
    public function testSuggest(): void
    {
        self::endpoint()->suggest('foo', 30);
        self::assertLastRequest('GET', '/api/contacts/suggest?search=foo&limit=30');
    }

    protected static function endpoint(): ContactsEndpoint
    {
        return self::dgs()->contacts();
    }
}
