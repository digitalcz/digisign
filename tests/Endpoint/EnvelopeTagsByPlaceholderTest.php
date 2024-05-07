<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\EnvelopeTagsByPlaceholder
 */
final class EnvelopeTagsByPlaceholderTest extends EndpointTestCase
{
    public function testCreate(): void
    {
        self::endpoint()->create(['foo' => 'bar']);
        self::assertLastRequest('POST', '/api/envelopes/bar/tags/by-placeholder', ['foo' => 'bar']);
    }

    protected static function endpoint(): EnvelopeTagsByPlaceholder
    {
        return self::dgs()->envelopes()->tags('bar')->byPlaceholder();
    }
}
