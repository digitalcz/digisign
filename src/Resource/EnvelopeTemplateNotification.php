<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplateNotification extends BaseResource
{
    use EntityResourceTrait;

    public string $type;

    public int $days;
}
