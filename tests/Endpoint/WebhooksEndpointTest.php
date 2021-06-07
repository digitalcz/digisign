<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\WebhooksEndpoint
 */
class WebhooksEndpointTest extends EndpointTestCase
{
    public function testChildren(): void
    {
        self::assertDefaultEndpointPath(self::endpoint()->attempts('foo'), '/api/webhooks/foo/attempts');
    }

    public function testCrud(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/webhooks');
    }

    public function testTest(): void
    {
        self::endpoint()->test('bar');
        self::assertLastRequest('POST', '/api/webhooks/bar/test');
    }

    protected static function endpoint(): WebhooksEndpoint
    {
        return self::dgs()->webhooks();
    }
}
