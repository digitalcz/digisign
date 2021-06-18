<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeTemplateDocumentsEndpoint
 */
class EnvelopeTemplateDocumentsEndpointTest extends EndpointTestCase
{
    public function testCRUD(): void
    {
        self::assertCrudRequests(self::endpoint(), '/api/envelope-templates/bar/documents');
    }

    protected static function endpoint(): EnvelopeTemplateDocumentsEndpoint
    {
        return self::dgs()->envelopeTemplates()->documents('bar');
    }
}
