<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use PHPUnit\Framework\Attributes\CoversClass;

#[CoversClass(AuthEndpoint::class)]
class AuthEndpointTest extends EndpointTestCase
{
    public function testAuthorize(): void
    {
        self::dgs()->auth()->authorize(['foo' => 'bar']);
        self::assertLastRequestMethodIsPost();
        self::assertLastRequestPath('/api/auth-token');
        self::assertLastRequestJsonBody(['foo' => 'bar']);
    }
}
