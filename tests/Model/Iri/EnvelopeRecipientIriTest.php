<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use PHPUnit\Framework\TestCase;

class EnvelopeRecipientIriTest extends TestCase
{
    public function testCreate(): void
    {
        $iri = EnvelopeRecipientIri::create(
            '94e04ccb-167e-4630-9952-db1e72fc30b4',
            'd9ea7867-df01-425d-9138-93f14709c2df'
        );
        self::assertEquals(
            '/api/envelopes/94e04ccb-167e-4630-9952-db1e72fc30b4/recipients/d9ea7867-df01-425d-9138-93f14709c2df',
            $iri->toString()
        );
        self::assertEquals(
            '/api/envelopes/94e04ccb-167e-4630-9952-db1e72fc30b4/recipients/d9ea7867-df01-425d-9138-93f14709c2df',
            (string)$iri
        );
        self::assertEquals(
            [
                'envelope' => '94e04ccb-167e-4630-9952-db1e72fc30b4',
                'recipient' => 'd9ea7867-df01-425d-9138-93f14709c2df'
            ],
            $iri->getParams()
        );
    }

    public function testParse(): void
    {
        $iri = EnvelopeRecipientIri::parse(
            '/api/envelopes/94e04ccb-167e-4630-9952-db1e72fc30b4/recipients/d9ea7867-df01-425d-9138-93f14709c2df'
        );
        self::assertEquals(
            '/api/envelopes/94e04ccb-167e-4630-9952-db1e72fc30b4/recipients/d9ea7867-df01-425d-9138-93f14709c2df',
            $iri->toString()
        );
        self::assertEquals(
            '/api/envelopes/94e04ccb-167e-4630-9952-db1e72fc30b4/recipients/d9ea7867-df01-425d-9138-93f14709c2df',
            (string)$iri
        );
        self::assertEquals(
            [
                'envelope' => '94e04ccb-167e-4630-9952-db1e72fc30b4',
                'recipient' => 'd9ea7867-df01-425d-9138-93f14709c2df'
            ],
            $iri->getParams()
        );
    }
}
