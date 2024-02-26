<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class IdentificationDocument extends BaseResource
{
    use EntityResourceTrait;

    public string $type;
    public File $front;
    public ?File $back;
}
