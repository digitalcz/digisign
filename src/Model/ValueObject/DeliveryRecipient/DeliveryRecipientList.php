<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\DeliveryRecipient;

use DigitalCz\DigiSign\Model\ValueObject\DeliveryRecipient;
use DigitalCz\DigiSign\Model\ValueObject\ListObject;

/**
 * @property array<mixed>|DeliveryRecipient[] $items
 * @method DeliveryRecipient[]|array[] getItems()
 */
class DeliveryRecipientList extends ListObject
{

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): DeliveryRecipientList
    {
        $items = [];

        foreach ($data['items'] as $value) {
            $items[] = DeliveryRecipient::fromArray($value);
        }

        return new DeliveryRecipientList($items, $data['count'], $data['page'], $data['itemsPerPage']);
    }
}
