<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class InspectionClaims extends BaseResource
{
    public ?string $givenNames;
    public ?string $surname;
    public ?DateTime $dateOfBirth;
    public ?int $age;
    public ?string $personalNumber;
    public ?string $placeOfBirth;
    public ?string $documentNumber;
    public ?string $gender;
}
