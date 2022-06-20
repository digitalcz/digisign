<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedIdCard extends BaseResource
{
    /** @var string|null */
    public $type;

    /** @var string|null */
    public $description;

    /** @var string|null */
    public $country;

    /** @var string|null */
    public $number;

    /** @var string|null */
    public $validTo;

    /** @var string|null */
    public $issuer;

    /** @var string|null */
    public $issueDate;
}
