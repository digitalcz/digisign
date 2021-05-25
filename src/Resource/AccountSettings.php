<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class AccountSettings extends BaseResource
{
    use EntityResourceTrait;

    public ?string $fullName;
    public ?string $shortName;
    public ?string $defaultSenderName;
    public ?string $defaultSenderEmail;
    public ?string $debuggingEmail;
    public ?string $identificationNumber;
    public ?string $vatNumber;
    public ?Image $logo;
    public ?Address $address;
}
