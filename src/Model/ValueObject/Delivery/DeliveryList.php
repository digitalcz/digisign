<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\Delivery;

use DigitalCz\DigiSign\Model\ValueObject\Delivery;
use DigitalCz\DigiSign\Model\ValueObject\ListObject;

/**
 * @property array<mixed>|Delivery[] $items
 * @method Delivery[]|array[] getItems()
 */
class DeliveryList extends ListObject
{

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): DeliveryList
    {
        $items = [];

        foreach ($data['items'] as $value) {
            $items[] = Delivery::fromArray($value);
        }

        return new Delivery\DeliveryList($items, $data['count'], $data['page'], $data['itemsPerPage']);
    }
}
