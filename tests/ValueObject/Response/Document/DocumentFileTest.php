<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject\Response\Document;

use PHPUnit\Framework\TestCase;

class DocumentFileTest extends TestCase
{
    public function testConstruct(): void
    {
        $object = new DocumentFile('b6fc9f51-9f12-40ce-8ba2-91df893694ab');

        self::assertSame('b6fc9f51-9f12-40ce-8ba2-91df893694ab', $object->getId());
    }

    public function testFromArray(): void
    {
        $data = [
            'id' => 'b6fc9f51-9f12-40ce-8ba2-91df893694ab',
        ];

        $object = DocumentFile::fromArray($data);

        self::assertSame($data['id'], $object->getId());
    }

    public function testToArray(): void
    {
        $data = [
            'id' => 'b6fc9f51-9f12-40ce-8ba2-91df893694ab',
        ];

        $authToken = DocumentFile::fromArray($data);

        self::assertSame($data, $authToken->toArray());
    }
}
