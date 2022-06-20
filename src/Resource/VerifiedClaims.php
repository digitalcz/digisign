<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedClaims extends BaseResource
{
    /** @var string */
    public $source;

    /** @var string|null  */
    public $txn;

    /** @var string|null  */
    public $sub;

    /** @var string|null  */
    public $name;

    /** @var string|null  */
    public $givenName;

    /** @var string|null  */
    public $familyName;

    /** @var string|null  */
    public $gender;

    /** @var string|null  */
    public $birthdate;

    /** @var string|null  */
    public $birthnumber;

    /** @var int|null  */
    public $age;

    /** @var bool|null  */
    public $majority;

    /** @var string|null  */
    public $birthplace;

    /** @var string|null  */
    public $primaryNationality;

    /** @var array<string> */
    public $nationalities;

    /** @var string|null  */
    public $maritalStatus;

    /** @var string|null  */
    public $email;

    /** @var string|null  */
    public $phoneNumber;

    /** @var bool|null  */
    public $pep;

    /** @var bool|null  */
    public $limitedLegalCapacity;

    /** @var Collection<VerifiedAddress> */
    public $addresses;

    /** @var Collection<VerifiedIdCard> */
    public $idCards;

    /** @var array<string> */
    public $paymentAccounts;

    /** @var VerifiedVerification|null */
    public $verification;
}
