<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedClaims extends BaseResource
{
    public string $source;

    public ?string $txn = null;

    public ?string $sub = null;

    public ?string $name = null;

    public ?string $givenName = null;

    public ?string $familyName = null;

    public ?string $gender = null;

    public ?string $birthdate = null;

    public ?string $birthnumber = null;

    public ?int $age = null;

    public ?bool $majority = null;

    public ?string $birthplace = null;

    public ?string $primaryNationality = null;

    /** @var array<string> */
    public array $nationalities;

    public ?string $maritalStatus = null;

    public ?string $email = null;

    public ?string $phoneNumber = null;

    public ?bool $pep = null;

    public ?bool $limitedLegalCapacity = null;

    /** @var Collection<VerifiedAddress> */
    public Collection $addresses;

    /** @var Collection<VerifiedIdCard> */
    public Collection $idCards;

    /** @var array<string> */
    public array $paymentAccounts;

    public ?VerifiedVerification $verification = null;
}
