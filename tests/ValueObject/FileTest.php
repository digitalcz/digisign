<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject;

use PHPUnit\Framework\TestCase;

class FileTest extends TestCase
{

    public function testConstruct(): void
    {
        $object = new File(
            '84dcf43b-9ddd-4847-8a77-3d8a14eef80',
            'dummy-5f230b68319cf978873898.pdf',
            'dummy.pdf',
            'application/pdf',
            10035,
            '6490304685c1cab33072adc5a4a6ad471029150d'
        );

        self::assertSame('84dcf43b-9ddd-4847-8a77-3d8a14eef80', $object->getId());
        self::assertSame('dummy-5f230b68319cf978873898.pdf', $object->getName());
        self::assertSame('dummy.pdf', $object->getOriginalName());
        self::assertSame('application/pdf', $object->getMimeType());
        self::assertSame(10035, $object->getSize());
        self::assertSame('6490304685c1cab33072adc5a4a6ad471029150d', $object->getSha1Checksum());
    }

    public function testToArray(): void
    {
        $object = new File(
            '84dcf43b-9ddd-4847-8a77-3d8a14eef80',
            'dummy-5f230b68319cf978873898.pdf',
            'dummy.pdf',
            'application/pdf',
            10035,
            '6490304685c1cab33072adc5a4a6ad471029150d'
        );

        $data = [
            'id' => '84dcf43b-9ddd-4847-8a77-3d8a14eef80',
            'name' => 'dummy-5f230b68319cf978873898.pdf',
            'originalName' => 'dummy.pdf',
            'mimeType' => 'application/pdf',
            'size' => 10035,
            'sha1Checksum' => '6490304685c1cab33072adc5a4a6ad471029150d',
        ];

        self::assertSame($data, $object->toArray());
    }
}
