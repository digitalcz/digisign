<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class IdentifyScenario extends BaseResource
{
    use EntityResourceTrait;

    public string $name;
    public bool $active;
}
