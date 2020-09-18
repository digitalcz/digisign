<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\EnvelopeTag;

use DigitalCz\DigiSign\Model\ValueObject\EnvelopeTag;
use DigitalCz\DigiSign\Model\ValueObject\ListObject;

class EnvelopeTagList extends ListObject
{

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): EnvelopeTagList
    {
        $items = [];

        foreach ($data['items'] as $value) {
            $items[] = EnvelopeTag::fromArray($value);
        }

        return new EnvelopeTagList($items, $data['count'], $data['page'], $data['itemsPerPage']);
    }
}
