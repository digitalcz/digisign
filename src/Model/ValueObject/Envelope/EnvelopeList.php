<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\Envelope;

use DigitalCz\DigiSign\Model\ValueObject\Envelope;
use DigitalCz\DigiSign\Model\ValueObject\ListObject;

/**
 * @property array<mixed>|Envelope[] $items
 * @method Envelope[]|array[] getItems()
 */
class EnvelopeList extends ListObject
{

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): EnvelopeList
    {
        $items = [];

        foreach ($data['items'] as $value) {
            $items[] = Envelope::fromArray($value);
        }

        return new Envelope\EnvelopeList($items, $data['count'], $data['page'], $data['itemsPerPage']);
    }
}
