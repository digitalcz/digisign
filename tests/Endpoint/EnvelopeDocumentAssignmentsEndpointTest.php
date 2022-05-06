<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeDocumentAssignmentsEndpoint
 */
final class EnvelopeDocumentAssignmentsEndpointTest extends EndpointTestCase
{
    public function testGet(): void
    {
        self::endpoint()->get();
        self::assertLastRequest('GET', '/api/envelopes/bar/documents/assignments');
    }

    public function testSet(): void
    {
        self::endpoint()->set([
            '8a071df9-aa9a-4607-9bc4-1c148ae6d384' => [
                'd73be485-731a-45b4-9566-489643952db0' => 'show',
                'ed37dd22-cd24-47c6-ab22-f014bcd30c9d' => 'hide',
            ],
        ]);

        self::assertLastRequest('PUT', '/api/envelopes/bar/documents/assignments');
    }

    protected static function endpoint(): EnvelopeDocumentAssignmentsEndpoint
    {
        return self::dgs()->envelopes()->documents('bar')->assignments();
    }
}
