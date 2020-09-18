<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use PHPUnit\Framework\TestCase;

class EnvelopeIriTest extends TestCase
{
    public function testCreate(): void
    {
        $iri = new EnvelopeIri('123456');
        self::assertEquals('/api/envelopes/123456', $iri->toString());
        self::assertEquals('/api/envelopes/123456', (string)$iri);
        self::assertEquals(['envelope' => '123456'], $iri->getParams());
    }
}
