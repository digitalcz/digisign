<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use PHPUnit\Framework\TestCase;

class EnvelopeRecipientIriTest extends TestCase
{
    public function testCreate(): void
    {
        $iri = new EnvelopeRecipientIri('123', '456');
        self::assertEquals('/api/envelopes/123/recipients/456', $iri->toString());
        self::assertEquals('/api/envelopes/123/recipients/456', (string)$iri);
        self::assertEquals(['envelope' => '123', 'recipient' => '456'], $iri->getParams());
    }

    public function testParse(): void
    {
        $iri = EnvelopeRecipientIri::parse('/api/envelopes/123/recipients/456');
        self::assertEquals('/api/envelopes/123/recipients/456', $iri->toString());
        self::assertEquals('/api/envelopes/123/recipients/456', (string)$iri);
        self::assertEquals(['envelope' => '123', 'recipient' => '456'], $iri->getParams());
    }
}
