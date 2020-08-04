<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject\Response;

use DigitalCz\DigiSign\ValueObject\Response\Document\DocumentFile;
use PHPUnit\Framework\TestCase;

class DocumentTest extends TestCase
{
    public function testConstruct(): void
    {
        $file = new DocumentFile('b6fc9f51-9f12-40ce-8ba2-91df893694ab');
        $object = new Document(
            '84dcf43b-9ddd-4847-8a77-3d8a14eef80',
            'dummy-5f230b68319cf978873898.pdf',
            $file,
            '123abc'
        );

        self::assertSame('84dcf43b-9ddd-4847-8a77-3d8a14eef80', $object->getId());
        self::assertSame('dummy-5f230b68319cf978873898.pdf', $object->getName());
        self::assertSame($file, $object->getFile());
        self::assertSame('123abc', $object->getMetadata());
    }

    public function testToArray(): void
    {
        $file = new DocumentFile('b6fc9f51-9f12-40ce-8ba2-91df893694ab');
        $object = new Document(
            '84dcf43b-9ddd-4847-8a77-3d8a14eef80',
            'dummy-5f230b68319cf978873898.pdf',
            $file,
            '123abc'
        );

        $data = [
            'id' => '84dcf43b-9ddd-4847-8a77-3d8a14eef80',
            'name' => 'dummy-5f230b68319cf978873898.pdf',
            'file' => ['id' => 'b6fc9f51-9f12-40ce-8ba2-91df893694ab'],
            'metadata' => '123abc',
        ];

        self::assertSame($data, $object->toArray());
    }


    public function testFromArray(): void
    {
        $data = [
            'id' => '84dcf43b-9ddd-4847-8a77-3d8a14eef80',
            'name' => 'dummy-5f230b68319cf978873898.pdf',
            'file' => ['id' => 'b6fc9f51-9f12-40ce-8ba2-91df893694ab'],
            'metadata' => '123abc',
        ];

        $object = Document::fromArray($data);

        self::assertSame('84dcf43b-9ddd-4847-8a77-3d8a14eef80', $object->getId());
        self::assertSame('dummy-5f230b68319cf978873898.pdf', $object->getName());
        self::assertSame(['id' => 'b6fc9f51-9f12-40ce-8ba2-91df893694ab'], $object->getFile()->toArray());
        self::assertSame('123abc', $object->getMetadata());
    }
}
