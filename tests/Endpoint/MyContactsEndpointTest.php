<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(MyContactsEndpoint::class)]
final class MyContactsEndpointTest extends EndpointTestCase
{
    public function testSuggest(): void
    {
        self::endpoint()->suggest('foo', 30);
        self::assertLastRequest('GET', '/api/my/contacts/suggest?search=foo&limit=30');
    }

    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/my/contacts');
    }

    protected static function endpoint(): MyContactsEndpoint
    {
        return self::dgs()->my()->contacts();
    }
}
