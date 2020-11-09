<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use PHPUnit\Framework\TestCase;

class EnvelopNotificationDataTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            'type' => 'toSignAfterSent',
            'days' => 3,
        ];

        $envelopeTagData = EnvelopeNotificationData::fromArray($data);

        self::assertSame($data['type'], $envelopeTagData->getType());
        self::assertSame($data['days'], $envelopeTagData->getDays());
    }


    public function testToArray(): void
    {
        $data = [
            'type' => 'toSignAfterSent',
            'days' => 3,
        ];

        $envelopeTagData = EnvelopeNotificationData::fromArray($data);

        self::assertSame($data, $envelopeTagData->toArray());
    }
}
