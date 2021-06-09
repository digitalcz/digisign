<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedClaims extends BaseResource
{
    /** @var string */
    public $source;

    /** @var string|null */
    public $sub;

    /** @var string|null */
    public $givenName;

    /** @var string|null */
    public $familyName;

    /** @var string|null */
    public $email;

    /** @var string|null */
    public $birthdate;

    /** @var string|null */
    public $phoneNumber;

    /** @var Collection<VerifiedAddress> */
    public $addresses;
}
