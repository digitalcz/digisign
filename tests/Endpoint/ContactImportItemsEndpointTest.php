<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\ContactImportItemsEndpoint
 */
final class ContactImportItemsEndpointTest extends EndpointTestCase
{
    public function testUpload(): void
    {
        self::endpoint()->upload(['foo' => 'bar']);
        self::assertLastRequest('POST', "/api/account/contacts/import/foo/items/upload", ['foo' => 'bar']);
    }

    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', "/api/account/contacts/import/foo/items?foo=bar");
    }

    protected static function endpoint(): ContactImportItemsEndpoint
    {
        return self::dgs()->account()->contacts()->import()->items('foo');
    }
}
