<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Contact extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public string $email;

    public ?string $mobile = null;

    public string $language;

    public ?string $address = null;

    public ?DateTime $birthdate = null;

    public ?string $birthnumber = null;

    public ?string $company = null;

    public ?string $identificationNumber = null;

    public ?string $function = null;

    public ?string $contractingParty = null;
}
