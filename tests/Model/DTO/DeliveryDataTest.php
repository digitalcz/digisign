<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class DeliveryDataTest extends TestCase
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

        $delivery = DeliveryData::fromArray($data);

        self::assertSame($data['emailSubject'], $delivery->getEmailSubject());
        self::assertSame($data['emailBody'], $delivery->getEmailBody());
        self::assertSame($data['senderName'], $delivery->getSenderName());
        self::assertSame($data['senderEmail'], $delivery->getSenderEmail());
        self::assertSame($data['validTo'], $delivery->getValidTo());
        self::assertSame($data['metadata'], $delivery->getMetadata());
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

        $delivery = DeliveryData::fromArray($data);

        $data['validTo'] = $validTo->format('c');

        self::assertSame($data, $delivery->toArray());
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

        $delivery = DeliveryData::fromArray($data);

        $validTo = new DateTimeImmutable('2009-09-09 09:09:09');

        $delivery->setEmailSubject('Hi Spajxo, needs sign!');
        $delivery->setEmailBody('Spešl sign!');
        $delivery->setSenderName('Spajxo');
        $delivery->setSenderEmail('spajxo@example.com');
        $delivery->setValidTo($validTo);
        $delivery->setMetadata('another-special-id');

        self::assertSame('Hi Spajxo, needs sign!', $delivery->getEmailSubject());
        self::assertSame('Spešl sign!', $delivery->getEmailBody());
        self::assertSame('Spajxo', $delivery->getSenderName());
        self::assertSame('spajxo@example.com', $delivery->getSenderEmail());
        self::assertSame($validTo, $delivery->getValidTo());
        self::assertSame('another-special-id', $delivery->getMetadata());
    }
}
