<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplateNotification extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $type;

    /** @var int */
    public $days;
}
