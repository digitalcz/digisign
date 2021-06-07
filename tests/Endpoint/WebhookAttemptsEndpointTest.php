<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\WebhookAttemptsEndpoint
 */
class WebhookAttemptsEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/webhooks/foo/attempts?foo=bar');
    }

    public function testGet(): void
    {
        self::endpoint()->get('bar');
        self::assertLastRequest('GET', '/api/webhooks/foo/attempts/bar');
    }

    public function testResend(): void
    {
        self::endpoint()->resend('bar');
        self::assertLastRequest('POST', '/api/webhooks/foo/attempts/bar/resend');
    }

    protected static function endpoint(): WebhookAttemptsEndpoint
    {
        return self::dgs()->webhooks()->attempts('foo');
    }
}
