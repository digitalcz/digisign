<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AccountBrandingsEndpoint
 */
class AccountBrandingsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/account/brandings');
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
