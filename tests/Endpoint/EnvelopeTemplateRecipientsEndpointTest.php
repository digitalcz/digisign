<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeTemplateRecipientsEndpoint
 */
class EnvelopeTemplateRecipientsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelope-templates/bar/recipients');
    }

    public function testSigningOrder(): void
    {
        self::endpoint()->signingOrder(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/envelope-templates/bar/recipients/signing-order');
    }

    protected static function endpoint(): EnvelopeTemplateRecipientsEndpoint
    {
        return self::dgs()->envelopeTemplates()->recipients('bar');
    }
}
