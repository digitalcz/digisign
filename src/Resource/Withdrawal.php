<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Withdrawal extends BaseResource
{
    use EntityResourceTrait;

    public string $email;
    public ?string $reason;
}
