<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use PHPUnit\Framework\TestCase;

class EnvelopeDocumentDataTest extends TestCase
{
    public function testFromArray(): void
    {
        $data = [
            'name' => 'Special for sign',
            'file' => '/api/files/0211f410-268a-4ac3-ac40-b41ee7647092',
            'metadata' => 'unique',
            'position' => 10,
        ];

        $document = EnvelopeDocumentData::fromArray($data);

        self::assertSame($data['name'], $document->getName());
        self::assertSame($data['file'], $document->getFile());
        self::assertSame($data['metadata'], $document->getMetadata());
        self::assertSame($data['position'], $document->getPosition());
    }

    public function testToArray(): void
    {
        $data = [
            'name' => 'Special for sign',
            'file' => '/api/files/0211f410-268a-4ac3-ac40-b41ee7647092',
            'metadata' => 'unique',
            'position' => 10,
        ];

        $document = EnvelopeDocumentData::fromArray($data);

        self::assertSame($data, $document->toArray());
    }

    public function testMethods(): void
    {
        $data = [
            'name' => 'foo',
            'file' => '/api/files/0211f410-268a-4ac3-ac40-b41ee7647092',
            'metadata' => 'foo-id',
            'position' => 10,
        ];

        $document = EnvelopeDocumentData::fromArray($data);

        $document->setName('bar');
        $document->setFile('/api/files/0211f410-268a-4ac3-ac40-b41ee7647099');
        $document->setMetadata('bar-id');
        $document->setPosition(5);

        self::assertSame('bar', $document->getName());
        self::assertSame('/api/files/0211f410-268a-4ac3-ac40-b41ee7647099', $document->getFile());
        self::assertSame('bar-id', $document->getMetadata());
        self::assertSame(5, $document->getPosition());
    }
}
