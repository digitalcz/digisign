<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Address extends BaseResource
{
    use EntityResourceTrait;

    public string $countryCode;

    public string $region;

    public string $city;

    public string $postalCode;

    public string $sortingCode;

    public string $addressLine1;

    public string $addressLine2;
}
