<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(ContactImportItemsEndpoint::class)]
final class ContactImportItemsEndpointTest extends EndpointTestCase
{
    public function testUpload(): void
    {
        self::endpoint()->upload(['foo' => 'bar']);
        self::assertLastRequest('POST', "/api/account/contacts/imports/foo/items/upload", ['foo' => 'bar']);
    }

    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', "/api/account/contacts/imports/foo/items?foo=bar");
    }

    protected static function endpoint(): ContactImportItemsEndpoint
    {
        return self::dgs()->account()->contacts()->imports()->items('foo');
    }
}
