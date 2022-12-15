<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedAddress extends BaseResource
{
    public ?string $type = null;

    public ?string $countryCode = null;

    public ?string $region = null;

    public ?string $city = null;

    public ?string $postalCode = null;

    public ?string $addressLine1 = null;

    public ?string $addressLine2 = null;
}
