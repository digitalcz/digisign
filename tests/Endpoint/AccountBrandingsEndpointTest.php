<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AccountBrandingsEndpoint::class)]
class AccountBrandingsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/account/brandings');
    }

    public function testListWithoutHal(): void
    {
        self::endpoint()->list([], false, false);
        self::assertLastRequest('GET', '/api/account/brandings?_actions=false&_links=false');
    }

    public function testInfo(): void
    {
        self::endpoint()->info();
        self::assertLastRequest('GET', "/api/account/brandings/info");
    }

    protected static function endpoint(): AccountBrandingsEndpoint
    {
        return self::dgs()->account()->brandings();
    }
}
