<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedAddress extends BaseResource
{
    /** @var string */
    public $type;

    /** @var string|null */
    public $countryCode;

    /** @var string|null */
    public $region;

    /** @var string|null */
    public $city;

    /** @var string|null */
    public $postalCode;

    /** @var string|null */
    public $addressLine1;

    /** @var string|null */
    public $addressLine2;
}
