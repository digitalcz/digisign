<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\DeliveryDocument;

use DigitalCz\DigiSign\Model\ValueObject\DeliveryDocument;
use DigitalCz\DigiSign\Model\ValueObject\ListObject;

/**
 * @property array<mixed>|DeliveryDocument[] $items
 * @method DeliveryDocument[]|array[] getItems()
 */
class DeliveryDocumentList extends ListObject
{

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): DeliveryDocumentList
    {
        $items = [];

        foreach ($data['items'] as $value) {
            $items[] = DeliveryDocument::fromArray($value);
        }

        return new DeliveryDocumentList($items, $data['count'], $data['page'], $data['itemsPerPage']);
    }
}
