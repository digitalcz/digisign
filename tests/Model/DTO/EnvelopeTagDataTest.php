<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use InvalidArgumentException;
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
            'recipient' =>
                '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/recipients/71526e98-0552-4968-9bea-b3d31841bf72',
            'document' =>
                '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/documents/71526e98-0552-4968-9bea-b3d31841bf72',
            'placeholder' => '@signer',
            'positioning' => 'center'
        ];

        $envelopeTagData = EnvelopeTagData::fromArray($data);

        self::assertSame($data['type'], $envelopeTagData->getType());
        self::assertSame($data['recipient'], $envelopeTagData->getRecipient());
        self::assertSame($data['document'], $envelopeTagData->getDocument());
        self::assertSame($data['page'], $envelopeTagData->getPage());
        self::assertSame($data['xPosition'], $envelopeTagData->getXPosition());
        self::assertSame($data['yPosition'], $envelopeTagData->getYPosition());
        self::assertSame($data['placeholder'], $envelopeTagData->getPlaceholder());
        self::assertSame($data['positioning'], $envelopeTagData->getPositioning());
    }


    public function testToArray(): void
    {
        $data = [
            'type' => 'signature',
            'page' => 1,
            'xPosition' => 10,
            'yPosition' => 100,
            'recipient' =>
                '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/recipients/71526e98-0552-4968-9bea-b3d31841bf72',
            'document' =>
                '/api/envelopes/0211f410-268a-4ac3-ac40-b41ee7647092/documents/71526e98-0552-4968-9bea-b3d31841bf72',
            'placeholder' => '@signer',
            'positioning' => 'center'
        ];

        $envelopeTagData = EnvelopeTagData::fromArray($data);

        self::assertSame($data, $envelopeTagData->toArray());
    }

    public function testInvalidArgument1Exception(): void
    {
        $data = [
            'type' => 'signature',
            'page' => 1,
            'xPosition' => 10,
            'yPosition' => 100,
            'recipient' =>
                123,
            'document' =>
                '/api/envelopes/3f4f8e5e-8936-46d4-a97e-6fbebf23d153/documents/0b635f61-245a-4e67-a3c0-af73e63d81dc',
            'placeholder' => '@signer',
            'positioning' => 'center'
        ];

        self::expectException(InvalidArgumentException::class);

        EnvelopeTagData::fromArray($data);
    }

    public function testInvalidArgument2Exception(): void
    {
        $data = [
            'type' => 'signature',
            'page' => 1,
            'xPosition' => 10,
            'yPosition' => 100,
            'recipient' =>
                '/api/envelopes/3f4f8e5e-8936-46d4-a97e-6fbebf23d153/recipients/0b635f61-245a-4e67-a3c0-af73e63d81dc',
            'document' =>
                123,
            'placeholder' => '@signer',
            'positioning' => 'center'
        ];
        self::expectException(InvalidArgumentException::class);

        EnvelopeTagData::fromArray($data);
    }
}
