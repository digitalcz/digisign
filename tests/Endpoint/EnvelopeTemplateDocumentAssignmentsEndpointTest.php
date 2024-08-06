<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeTemplateDocumentAssignmentEndpoint
 */
final class EnvelopeTemplateDocumentAssignmentsEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/envelope-templates/bar/documents/assignments');
    }

    public function testSet(): void
    {
        self::endpoint()->set([
            '8a071df9-aa9a-4607-9bc4-1c148ae6d384' => [
                'd73be485-731a-45b4-9566-489643952db0' => 'show',
                'ed37dd22-cd24-47c6-ab22-f014bcd30c9d' => 'hide',
            ],
        ]);

        self::assertLastRequest('PUT', '/api/envelope-templates/bar/documents/assignments', [
            '8a071df9-aa9a-4607-9bc4-1c148ae6d384' => [
                'd73be485-731a-45b4-9566-489643952db0' => 'show',
                'ed37dd22-cd24-47c6-ab22-f014bcd30c9d' => 'hide',
            ],
        ]);
    }

    protected static function endpoint(): EnvelopeTemplateDocumentAssignmentEndpoint
    {
        return self::dgs()->envelopeTemplates()->documents('bar')->assignments();
    }
}
