<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

use DateTimeImmutable;
use PHPUnit\Framework\TestCase;

class EnvelopeTagTest extends TestCase
{
    public function testConstruct(): void
    {
        $date = new DateTimeImmutable('2020-09-09 09:09:09');
        $tag = new EnvelopeTag('your-id-example', 'signature', 1, 10, 100, $date, $date);

        self::assertSame('your-id-example', $tag->getId());
        self::assertSame('signature', $tag->getType());
        self::assertSame(1, $tag->getPage());
        self::assertSame(10, $tag->getXPosition());
        self::assertSame(100, $tag->getYPosition());
        self::assertSame($date, $tag->getCreatedAt());
        self::assertSame($date, $tag->getUpdatedAt());
    }

    public function testFromArray(): void
    {
        $date = new DateTimeImmutable('2020-09-09 09:09:09');

        $data = [
            'id' => 'some-id',
            'type' => 'signature',
            'page' => 1,
            'xPosition' => 10,
            'yPosition' => 100,
            'createdAt' => $date->format('c'),
            'updatedAt' => $date->format('c'),
        ];

        $tag = EnvelopeTag::fromArray($data);

        self::assertSame($data['id'], $tag->getId());
        self::assertSame($data['type'], $tag->getType());
        self::assertSame($data['page'], $tag->getPage());
        self::assertSame($data['xPosition'], $tag->getXPosition());
        self::assertSame($data['yPosition'], $tag->getYPosition());
        self::assertSame($data['createdAt'], $tag->getCreatedAt()->format('c'));
        self::assertSame($data['updatedAt'], $tag->getUpdatedAt()->format('c'));
    }

    public function testToArray(): void
    {
        $date = new DateTimeImmutable('2020-09-09 09:09:09');

        $data = [
            'id' => 'some-id',
            'type' => 'signature',
            'page' => 1,
            'xPosition' => 10,
            'yPosition' => 100,
            'createdAt' => $date->format('c'),
            'updatedAt' => $date->format('c'),
        ];

        $tag = EnvelopeTag::fromArray($data);

        self::assertSame($data, $tag->toArray());
    }
}
