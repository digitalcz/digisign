<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use PHPUnit\Framework\TestCase;

class DeliveryRecipientDataTest extends TestCase
{

    public function testFromArray(): void
    {
        $data = [
            'name' => 'Hans',
            'email' => 'hans@digital.cz',
            'mobile' => '+420666888999',
            'metadata' => 'hans-id',
            'emailBody' => 'Hi, Hans!',
        ];

        $recipient = DeliveryRecipientData::fromArray($data);

        self::assertSame($data['name'], $recipient->getName());
        self::assertSame($data['email'], $recipient->getEmail());
        self::assertSame($data['mobile'], $recipient->getMobile());
        self::assertSame($data['metadata'], $recipient->getMetadata());
        self::assertSame($data['emailBody'], $recipient->getEmailBody());
    }

    public function testToArray(): void
    {
        $data = [
            'name' => 'Hans',
            'email' => 'hans@digital.cz',
            'mobile' => '+420666888999',
            'metadata' => 'hans-id',
            'emailBody' => 'Hi, Hans!',
        ];

        $recipient = DeliveryRecipientData::fromArray($data);

        self::assertSame($data, $recipient->toArray());
    }

    public function testMethods(): void
    {
        $data = [
            'name' => 'Hans',
            'email' => 'hans@digital.cz',
            'mobile' => '+420666888999',
            'metadata' => 'hans-id',
            'emailBody' => 'Hi, Hans!',
        ];

        $recipient = DeliveryRecipientData::fromArray($data);

        $recipient->setName('Spajxo');
        $recipient->setEmail('spajxo@digital.cz');
        $recipient->setMobile('+420777888999');
        $recipient->setEmailBody('HI, Spajxo!');
        $recipient->setMetadata('spajxo-id');

        self::assertSame('Spajxo', $recipient->getName());
        self::assertSame('spajxo@digital.cz', $recipient->getEmail());
        self::assertSame('+420777888999', $recipient->getMobile());
        self::assertSame('HI, Spajxo!', $recipient->getEmailBody());
        self::assertSame('spajxo-id', $recipient->getMetadata());
    }
}
