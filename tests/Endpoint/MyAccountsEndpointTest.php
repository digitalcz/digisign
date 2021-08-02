<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\MyAccountsEndpoint
 */
class MyAccountsEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        $this->endpoint()->list();
        self::assertLastRequest('GET', '/api/my/accounts');
    }

    public function testCreate(): void
    {
        $this->endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', "/api/my/accounts", ['foo' => 'bar']);
    }

    private function endpoint(): MyAccountsEndpoint
    {
        return self::dgs()->my()->accounts();
    }
}
