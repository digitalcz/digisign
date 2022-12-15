<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeNotification extends BaseResource
{
    use EntityResourceTrait;

    public string $type;

    public int $days;

    public ?DateTime $cancelledAt = null;
}
