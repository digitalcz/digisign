<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\Envelope;

use DigitalCz\DigiSign\Model\Stream;
use PHPUnit\Framework\TestCase;

class EnvelopeFileTest extends TestCase
{
    public function testConstruct(): void
    {
        $stream = Stream::fromTemp();

        $envelopeEmbed = new EnvelopeFile(
            'attachment; filename=test.pdf',
            'application/octet-stream',
            666,
            $stream
        );

        self::assertSame('attachment; filename=test.pdf', $envelopeEmbed->getContentDisposition());
        self::assertSame('application/octet-stream', $envelopeEmbed->getContentType());
        self::assertSame(666, $envelopeEmbed->getContentLength());
        self::assertSame($stream, $envelopeEmbed->getStream());
        self::assertSame('test.pdf', $envelopeEmbed->getFilenameFromContentDisposition());
    }
}
