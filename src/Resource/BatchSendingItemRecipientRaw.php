<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class BatchSendingItemRecipientRaw extends BaseResource
{
    public string $alias;

    public string $name;

    public string $email;

    public ?string $mobile;

    public ?string $company;

    public ?string $function;

    public ?string $contractingParty;

    public ?string $birthdate;

    public ?string $birthnumber;

    public ?string $identificationNumber;

    public ?string $address;
}
