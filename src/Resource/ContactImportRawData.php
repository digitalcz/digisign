<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

final class ContactImportRawData extends BaseResource
{
    public ?string $name;

    public ?string $email;

    public ?string $mobile;

    public ?string $company;

    public ?string $function;

    public ?string $contractingParty;

    public ?string $birthdate;

    public ?string $birthnumber;

    public ?string $identificationNumber;

    public ?string $address;
}
