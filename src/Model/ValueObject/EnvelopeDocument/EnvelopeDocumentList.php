<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\EnvelopeDocument;

use DigitalCz\DigiSign\Model\ValueObject\EnvelopeDocument;
use DigitalCz\DigiSign\Model\ValueObject\ListObject;

/**
 * @property array<mixed>|EnvelopeDocument[] $items
 * @method EnvelopeDocument[]|array[] getItems()
 */
class EnvelopeDocumentList extends ListObject
{

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): EnvelopeDocumentList
    {
        $items = [];

        foreach ($data['items'] as $value) {
            $items[] = EnvelopeDocument::fromArray($value);
        }

        return new EnvelopeDocumentList($items, $data['count'], $data['page'], $data['itemsPerPage']);
    }
}
