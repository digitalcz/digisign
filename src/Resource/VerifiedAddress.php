<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedAddress extends BaseResource
{
    public string $type;
    public ?string $countryCode;
    public ?string $region;
    public ?string $city;
    public ?string $postalCode;
    public ?string $addressLine1;
    public ?string $addressLine2;
}
