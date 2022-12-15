<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedIdCard extends BaseResource
{
    public ?string $type = null;

    public ?string $description = null;

    public ?string $country = null;

    public ?string $number = null;

    public ?string $validTo = null;

    public ?string $issuer = null;

    public ?string $issueDate = null;
}
