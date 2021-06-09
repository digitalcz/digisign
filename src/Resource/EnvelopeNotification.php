<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeNotification extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $type;

    /** @var int */
    public $days;

    /** @var DateTime|null */
    public $cancelledAt;
}
