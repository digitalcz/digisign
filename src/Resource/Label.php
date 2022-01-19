<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Label extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $name;

    /** @var string */
    public $color;
}
