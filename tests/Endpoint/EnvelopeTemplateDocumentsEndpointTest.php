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

    public function testDownload(): void
    {
        self::endpoint()->download('foo', ['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/envelope-templates/bar/documents/foo/download?foo=bar');
    }

    public function testDocumentOrder(): void
    {
        self::endpoint()->documentOrder(['foo' => 'bar']);
        self::assertLastRequest('PUT', '/api/envelope-templates/bar/documents/document-order');
    }

    protected static function endpoint(): EnvelopeTemplateDocumentsEndpoint
    {
        return self::dgs()->envelopeTemplates()->documents('bar');
    }
}
