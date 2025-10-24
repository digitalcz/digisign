<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\ContactImportsEndpoint
 */
final class ContactImportsEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->items('foo'), '/api/account/contacts/imports/foo/items');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', "/api/account/contacts/imports/foo");
    }

    public function testUpdate(): void
    {
        self::endpoint()->update('foo', ['foo' => 'bar']);

        self::assertLastRequest('PUT', "/api/account/contacts/imports/foo", ['foo' => 'bar']);
    }

    public function testDelete(): void
    {
        self::endpoint()->delete('foo');
        self::assertLastRequest('DELETE', "/api/account/contacts/imports/foo");
    }

    public function testCreate(): void
    {
        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', "/api/account/contacts/imports", ['foo' => 'bar']);
    }

    protected static function endpoint(): ContactImportsEndpoint
    {
        return self::dgs()->account()->contacts()->imports();
    }
}
