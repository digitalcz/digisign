<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class EnvelopeNotificationTest extends TestCase
{

    public function testFromArray(): void
    {
        $date = new DateTimeImmutable('2020-09-09 09:09:09');

        $data = [
            'id' => '6c4ff451-ec4c-461b-8b64-afb843db2883',
            'type' => 'toSignAfterSent',
            'days' => 3,
            'status' => 'waiting',
            'createdAt' => $date->format('c'),
            'updatedAt' => $date->format('c'),
            'sentAt' => $date->format('c'),
            'cancelledAt' => $date->format('c'),
        ];

        $tag = EnvelopeNotification::fromArray($data);

        self::assertSame($data['id'], $tag->getId());
        self::assertSame($data['type'], $tag->getType());
        self::assertSame($data['days'], $tag->getDays());
        self::assertSame($data['status'], $tag->getStatus());
        self::assertSame($data['sentAt'], $tag->getSentAt() !== null ? $tag->getSentAt()->format('c') : null);
        self::assertSame(
            $data['cancelledAt'],
            $tag->getCancelledAt() !== null ? $tag->getCancelledAt()->format('c') : null
        );
        self::assertSame($data['createdAt'], $tag->getCreatedAt()->format('c'));
        self::assertSame($data['updatedAt'], $tag->getUpdatedAt()->format('c'));
    }

    public function testToArray(): void
    {
        $date = new DateTimeImmutable('2020-09-09 09:09:09');

        $data = [
            'id' => '6c4ff451-ec4c-461b-8b64-afb843db2883',
            'type' => 'toSignAfterSent',
            'days' => 3,
            'status' => 'waiting',
            'createdAt' => $date->format('c'),
            'updatedAt' => $date->format('c'),
            'sentAt' => $date->format('c'),
            'cancelledAt' => $date->format('c'),
        ];

        $tag = EnvelopeNotification::fromArray($data);

        self::assertSame($data, $tag->toArray());
    }
}
