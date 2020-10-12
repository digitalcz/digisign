<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

use PHPUnit\Framework\TestCase;

class IriTest extends TestCase
{

    public function testToStringException(): void
    {
        $template = new IriTemplate('/api/envelopes/{envelope}/tags/{tag}');
        $iri = new Iri($template);

        self::assertSame('', $iri->toString());
    }
}
