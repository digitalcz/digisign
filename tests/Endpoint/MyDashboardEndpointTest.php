<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(MyDashboardEndpoint::class)]
class MyDashboardEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        $this->endpoint()->get();
        self::assertLastRequest('GET', '/api/my/dashboard');
    }

    private function endpoint(): MyDashboardEndpoint
    {
        return self::dgs()->my()->dashboard();
    }
}
