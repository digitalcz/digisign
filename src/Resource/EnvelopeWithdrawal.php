<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeWithdrawal extends BaseResource
{
    use EntityResourceTrait;

    public ?string $email = null;

    public ?string $reason = null;
}
