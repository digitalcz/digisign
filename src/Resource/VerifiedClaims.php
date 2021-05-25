<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedClaims extends BaseResource
{
    public string $source;
    public ?string $sub;
    public ?string $givenName;
    public ?string $familyName;
    public ?string $email;
    public ?string $birthdate;
    public ?string $phoneNumber;

    /** @var Collection<VerifiedAddress> */
    public Collection $addresses;
}
