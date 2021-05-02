<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\AuthEndpoint
 */
class AuthEndpointTest extends EndpointTestCase
{
    public function testAuthorize(): void
    {
        self::digiSign()->auth()->authorize(['foo' => 'bar']);
        self::assertLastRequestMethodIsPost();
        self::assertLastRequestPath('/api/auth-token');
        self::assertLastRequestJsonBody(['foo' => 'bar']);
    }
}
