<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AccountContactsEndpoint::class)]
class AccountContactsEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->imports(), '/api/account/contacts/imports');
    }

    public function testList(): void
    {
        self::endpoint()->list(['search' => 'John']);
        self::assertLastRequest('GET', '/api/account/contacts?search=John');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/account/contacts/foo');
    }

    public function testCreate(): void
    {
        self::endpoint()->create([
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'language' => 'en',
        ]);
        self::assertLastRequest('POST', '/api/account/contacts', [
            'name' => 'John Doe',
            'email' => 'john@example.com',
            'language' => 'en',
        ]);
    }

    public function testUpdate(): void
    {
        self::endpoint()->update('foo', [
            'name' => 'Jane Doe',
            'mobile' => '+420775123456',
        ]);
        self::assertLastRequest('PUT', '/api/account/contacts/foo', [
            'name' => 'Jane Doe',
            'mobile' => '+420775123456',
        ]);
    }

    public function testDelete(): void
    {
        self::endpoint()->delete('foo');
        self::assertLastRequest('DELETE', '/api/account/contacts/foo');
    }

    protected static function endpoint(): AccountContactsEndpoint
    {
        return self::dgs()->account()->contacts();
    }
}
