<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\EnvelopeRecipient;

use DigitalCz\DigiSign\Model\ValueObject\EnvelopeRecipient;
use DigitalCz\DigiSign\Model\ValueObject\ListObject;

class EnvelopeRecipientList extends ListObject
{

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): EnvelopeRecipientList
    {
        $items = [];

        foreach ($data['items'] as $value) {
            $items[] = EnvelopeRecipient::fromArray($value);
        }

        return new EnvelopeRecipientList($items, $data['count'], $data['page'], $data['itemsPerPage']);
    }
}
