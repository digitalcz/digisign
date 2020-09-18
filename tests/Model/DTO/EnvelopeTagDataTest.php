<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use PHPUnit\Framework\TestCase;

class EnvelopeTagDataTest extends TestCase
{
    public function testFromArray(): void
    {

        $data = [
            'type' => 'signature',
            'page' => 1,
            'xPosition' => 10,
            'yPosition' => 100,
            'recipient' => '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/recipient/xxx',
            'document' => '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/documents/xxx',
        ];

        $envelopeTagData = EnvelopeTagData::fromArray($data);

        self::assertSame($data['type'], $envelopeTagData->getType());
        self::assertSame($data['recipient'], $envelopeTagData->getRecipient());
        self::assertSame($data['document'], $envelopeTagData->getDocument());
        self::assertSame($data['page'], $envelopeTagData->getPage());
        self::assertSame($data['xPosition'], $envelopeTagData->getXPosition());
        self::assertSame($data['yPosition'], $envelopeTagData->getYPosition());
    }


    public function testToArray(): void
    {
        $data = [
            'type' => 'signature',
            'page' => 1,
            'xPosition' => 10,
            'yPosition' => 100,
            'recipient' => '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/recipient/xxx',
            'document' => '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/documents/xxx',
        ];

        $envelopeTagData = EnvelopeTagData::fromArray($data);

        self::assertSame($data, $envelopeTagData->toArray());
    }
}
