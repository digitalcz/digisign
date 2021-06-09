<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Address extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $countryCode;

    /** @var string */
    public $region;

    /** @var string */
    public $city;

    /** @var string */
    public $postalCode;

    /** @var string */
    public $sortingCode;

    /** @var string */
    public $addressLine1;

    /** @var string */
    public $addressLine2;
}
