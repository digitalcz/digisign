<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use PHPUnit\Framework\TestCase;

class EnvelopeDocumentIriTest extends TestCase
{
    public function testCreate(): void
    {
        $iri = new EnvelopeDocumentIri('123', '456');
        self::assertEquals('/api/envelopes/123/documents/456', $iri->toString());
        self::assertEquals('/api/envelopes/123/documents/456', (string)$iri);
        self::assertEquals(['envelope' => '123', 'document' => '456'], $iri->getParams());
    }

    public function testParse(): void
    {
        $iri = EnvelopeDocumentIri::parse('/api/envelopes/123/documents/456');
        self::assertEquals('/api/envelopes/123/documents/456', $iri->toString());
        self::assertEquals('/api/envelopes/123/documents/456', (string)$iri);
        self::assertEquals(['envelope' => '123', 'document' => '456'], $iri->getParams());
    }
}
