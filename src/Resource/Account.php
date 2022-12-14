<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Account extends BaseResource
{
    use EntityResourceTrait;

    public string $status;
    public string $email;
    public int $number;
    public AccountSettings $settings;
    public ?IdentityProvider $identityProvider;
}
