<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\EnvelopeNotification;

use DigitalCz\DigiSign\Model\ValueObject\EnvelopeNotification;
use DigitalCz\DigiSign\Model\ValueObject\ListObject;

class EnvelopeNotificationList extends ListObject
{

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): EnvelopeNotificationList
    {
        $items = [];

        foreach ($data['items'] as $value) {
            $items[] = EnvelopeNotification::fromArray($value);
        }

        return new EnvelopeNotificationList($items, $data['count'], $data['page'], $data['itemsPerPage']);
    }
}
