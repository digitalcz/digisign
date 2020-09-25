<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use PHPUnit\Framework\TestCase;

class EnvelopeDocumentIriTest extends TestCase
{
    public function testCreate(): void
    {
        $iri = EnvelopeDocumentIri::create(
            '7cac3101-404e-4aad-9de0-a3a00c3bf6a1',
            'a7fea5ef-cdcc-4fee-bce1-c242358b5961'
        );
        self::assertEquals(
            '/api/envelopes/7cac3101-404e-4aad-9de0-a3a00c3bf6a1/documents/a7fea5ef-cdcc-4fee-bce1-c242358b5961',
            $iri->toString()
        );
        self::assertEquals(
            '/api/envelopes/7cac3101-404e-4aad-9de0-a3a00c3bf6a1/documents/a7fea5ef-cdcc-4fee-bce1-c242358b5961',
            (string)$iri
        );
        self::assertEquals(
            [
                'envelope' => '7cac3101-404e-4aad-9de0-a3a00c3bf6a1',
                'document' => 'a7fea5ef-cdcc-4fee-bce1-c242358b5961'
            ],
            $iri->getParams()
        );
    }

    public function testParse(): void
    {
        $iri = EnvelopeDocumentIri::parse(
            '/api/envelopes/7cac3101-404e-4aad-9de0-a3a00c3bf6a1/documents/a7fea5ef-cdcc-4fee-bce1-c242358b5961'
        );
        self::assertEquals(
            '/api/envelopes/7cac3101-404e-4aad-9de0-a3a00c3bf6a1/documents/a7fea5ef-cdcc-4fee-bce1-c242358b5961',
            $iri->toString()
        );
        self::assertEquals(
            '/api/envelopes/7cac3101-404e-4aad-9de0-a3a00c3bf6a1/documents/a7fea5ef-cdcc-4fee-bce1-c242358b5961',
            (string)$iri
        );
        self::assertEquals(
            [
                'envelope' => '7cac3101-404e-4aad-9de0-a3a00c3bf6a1',
                'document' => 'a7fea5ef-cdcc-4fee-bce1-c242358b5961'
            ],
            $iri->getParams()
        );
    }
}
