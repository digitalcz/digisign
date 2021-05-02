<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\WebhooksEndpoint
 */
class WebhooksEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/webhooks?foo=bar');
    }

    public function testCreate(): void
    {
        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/webhooks', ['foo' => 'bar']);
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/webhooks/foo');
    }

    public function testDelete(): void
    {
        self::endpoint()->delete('foo');
        self::assertLastRequest('DELETE', '/api/webhooks/foo');
    }

    protected static function endpoint(): WebhooksEndpoint
    {
        return self::digiSign()->webhooks();
    }
}
