<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\RecipientBlockEndpoint
 */
class RecipientBlockEndpointTest extends EndpointTestCase
{
    public function testEnvelopeGet(): void
    {
        self::digiSign()->envelopes()->recipients('bar')->block('foo')->get();
        self::assertLastRequest('GET', '/api/envelopes/bar/recipients/foo/block');
    }

    public function testEnvelopeDelete(): void
    {
        self::digiSign()->envelopes()->recipients('bar')->block('foo')->delete();
        self::assertLastRequest('DELETE', '/api/envelopes/bar/recipients/foo/block');
    }

    public function testDeliveryGet(): void
    {
        self::digiSign()->deliveries()->recipients('bar')->block('foo')->get();
        self::assertLastRequest('GET', '/api/deliveries/bar/recipients/foo/block');
    }

    public function testDeliveryDelete(): void
    {
        self::digiSign()->deliveries()->recipients('bar')->block('foo')->delete();
        self::assertLastRequest('DELETE', '/api/deliveries/bar/recipients/foo/block');
    }
}
