<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

final class SubjectProfile extends BaseResource
{
    public ?string $companyName = null;
    public ?string $email = null;
    public Address $address;
    public ?string $identificationNumber = null;
    public ?string $vatNumber = null;
}
