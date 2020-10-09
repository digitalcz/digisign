<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\Envelope;

use DigitalCz\DigiSign\Model\ValueObject\Envelope;
use PHPUnit\Framework\TestCase;

class EnvelopeListTest extends TestCase
{
    public function testConstruct(): void
    {
        $data = [
            'items' => [
                [
                    'id' => '00018b71-18cf-4059-b8f7-ea5f108c3175',
                    'emailSubject' => "Sign!",
                    'emailBody' => 'Hi, please sign!',
                    'status' => 'sent',
                    'recipients' => [],
                    'documents' => [],
                    'senderName' => null,
                    'senderEmail' => null,
                    'validTo' => null,
                    'sentAt' => null,
                    'completedAt' => null,
                    'cancelledAt' => null,
                    'declinedAt' => null,
                    'metadata' => null,
                ]
            ],
            'count' => 1,
            'page' => 1,
            'itemsPerPage' => 10,
        ];

        $envelope = Envelope::fromArray(reset($data['items']));
        $list = EnvelopeList::fromArray($data);

        self::assertEquals([$envelope], $list->getItems());
        self::assertEquals($data['count'], $list->getCount());
        self::assertEquals($data['page'], $list->getPage());
        self::assertEquals($data['itemsPerPage'], $list->getItemsPerPage());
    }
}
