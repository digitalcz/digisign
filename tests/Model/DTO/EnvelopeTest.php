<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class EnvelopeTest extends TestCase
{

    public function testFromArray(): void
    {
        $validTo = new DateTimeImmutable('2020-09-09 09:09:09');

        $data = [
            'emailSubject' => 'Special for sign',
            'emailBody' => 'Hi Hans, please sign!',
            'senderName' => 'Hans',
            'senderEmail' => 'hans@example.com',
            'validTo' => $validTo,
            'metadata' => 'my-special-id',
        ];

        $envelope = EnvelopeData::fromArray($data);

        self::assertSame($data['emailSubject'], $envelope->getEmailSubject());
        self::assertSame($data['emailBody'], $envelope->getEmailBody());
        self::assertSame($data['senderName'], $envelope->getSenderName());
        self::assertSame($data['senderEmail'], $envelope->getSenderEmail());
        self::assertSame($data['validTo'], $envelope->getValidTo());
        self::assertSame($data['metadata'], $envelope->getMetadata());
    }

    public function testToArray(): void
    {
        $validTo = new DateTimeImmutable('2020-09-09 09:09:09');

        $data = [
            'emailSubject' => 'Special for sign',
            'emailBody' => 'Hi Hans, please sign!',
            'senderName' => 'Hans',
            'senderEmail' => 'hans@example.com',
            'validTo' => $validTo,
            'metadata' => 'my-special-id',
        ];

        $envelope = EnvelopeData::fromArray($data);

        $data['validTo'] = $validTo->format('c');

        self::assertSame($data, $envelope->toArray());
    }

    public function testMethods(): void
    {
        $validTo = new DateTimeImmutable('2020-09-09 09:09:09');

        $data = [
            'emailSubject' => 'Special for sign',
            'emailBody' => 'Hi Hans, please sign!',
            'senderName' => 'Hans',
            'senderEmail' => 'hans@example.com',
            'validTo' => $validTo,
            'metadata' => 'my-special-id',
        ];

        $envelope = EnvelopeData::fromArray($data);

        $validTo = new DateTimeImmutable('2009-09-09 09:09:09');

        $envelope->setEmailSubject('Hi Spajxo, needs sign!');
        $envelope->setEmailBody('Spešl sign!');
        $envelope->setSenderName('Spajxo');
        $envelope->setSenderEmail('spajxo@example.com');
        $envelope->setValidTo($validTo);
        $envelope->setMetadata('another-special-id');

        self::assertSame('Hi Spajxo, needs sign!', $envelope->getEmailSubject());
        self::assertSame('Spešl sign!', $envelope->getEmailBody());
        self::assertSame('Spajxo', $envelope->getSenderName());
        self::assertSame('spajxo@example.com', $envelope->getSenderEmail());
        self::assertSame($validTo, $envelope->getValidTo());
        self::assertSame('another-special-id', $envelope->getMetadata());
    }
}
