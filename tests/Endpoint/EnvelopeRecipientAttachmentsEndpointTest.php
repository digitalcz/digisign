<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeRecipientAttachmentsEndpoint
 */
class EnvelopeRecipientAttachmentsEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list();
        self::assertLastRequest('GET', '/api/envelopes/bar/recipients/foo/attachments');
    }

    public function testGet(): void
    {
        self::endpoint()->get('moo');
        self::assertLastRequest('GET', '/api/envelopes/bar/recipients/foo/attachments/moo');
    }

    public function testDownload(): void
    {
        self::endpoint()->download('moo');
        self::assertLastRequest('GET', '/api/envelopes/bar/recipients/foo/attachments/moo/download');
    }

    protected static function endpoint(): EnvelopeRecipientAttachmentsEndpoint
    {
        return self::dgs()->envelopes()->recipients('bar')->attachments('foo');
    }
}
