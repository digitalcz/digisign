<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\Envelope;

use PHPUnit\Framework\TestCase;

class EnvelopeEmbedTest extends TestCase
{
    public function testConstruct(): void
    {
        $envelopeEmbed = new EnvelopeEmbed('your-token-example', 666);

        self::assertSame('your-token-example', $envelopeEmbed->getToken());
        self::assertSame(666, $envelopeEmbed->getExpiresAt());
    }

    public function testFromArray(): void
    {
        $data = [
            'token' => 'your-token-example',
            'expiresAt' => 666,
        ];

        $envelopeEmbed = EnvelopeEmbed::fromArray($data);

        self::assertSame($data['token'], $envelopeEmbed->getToken());
        self::assertSame($data['expiresAt'], $envelopeEmbed->getExpiresAt());
    }

    public function testToArray(): void
    {
        $data = [
            'token' => 'your-token-example',
            'expiresAt' => 666,
        ];

        $envelopeEmbed = EnvelopeEmbed::fromArray($data);

        self::assertSame($data, $envelopeEmbed->toArray());
    }
}
