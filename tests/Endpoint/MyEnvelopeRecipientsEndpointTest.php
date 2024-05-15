<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\MyEnvelopeRecipientsEndpoint
 */
class MyEnvelopeRecipientsEndpointTest extends EndpointTestCase
{
    public function testEmbed(): void
    {
        self::endpoint()->embed('bar', []);
        self::assertLastRequest('POST', '/api/my/envelopes/foo/recipients/bar/embed');
    }

    protected static function endpoint(): MyEnvelopeRecipientsEndpoint
    {
        return self::dgs()->my()->envelopes()->recipients('foo');
    }
}
