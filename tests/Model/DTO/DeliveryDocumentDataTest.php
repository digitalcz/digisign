<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use PHPUnit\Framework\TestCase;

class DeliveryDocumentDataTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            'name' => 'Special for sign',
            'file' => '/api/files/0211f410-268a-4ac3-ac40-b41ee7647092',
            'metadata' => 'unique',
        ];

        $document = DeliveryDocumentData::fromArray($data);

        self::assertSame($data['name'], $document->getName());
        self::assertSame($data['file'], $document->getFile());
        self::assertSame($data['metadata'], $document->getMetadata());
    }

    public function testToArray(): void
    {
        $data = [
            'name' => 'Special for sign',
            'file' => '/api/files/0211f410-268a-4ac3-ac40-b41ee7647092',
            'metadata' => 'unique',
        ];

        $document = DeliveryDocumentData::fromArray($data);

        self::assertSame($data, $document->toArray());
    }

    public function testMethods(): void
    {
        $data = [
            'name' => 'foo',
            'file' => '/api/files/foo',
            'metadata' => 'foo-id',
        ];

        $document = DeliveryDocumentData::fromArray($data);

        $document->setName('bar');
        $document->setFile('/api/files/bar');
        $document->setMetadata('bar-id');

        self::assertSame('bar', $document->getName());
        self::assertSame('/api/files/bar', $document->getFile());
        self::assertSame('bar-id', $document->getMetadata());
    }
}
