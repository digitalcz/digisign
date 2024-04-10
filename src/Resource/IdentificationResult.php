<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class IdentificationResult extends BaseResource
{
    use EntityResourceTrait;

    public ?IdentificationDocument $primaryDocument;
    public ?IdentificationDocument $secondaryDocument;
    public ?IdentificationBankStatement $bankStatement;
    public ?IdentificationSelfie $selfie;
    public ?IdentificationInspection $inspection;
    public ?string $givenNames;
    public ?string $surname;
    public ?DateTime $dateOfBirth;
    public ?string $gender;
    public ?string $nationality;
    public ?int $age;
    public ?string $personalNumber;
    public ?string $documentNumber;
    public ?DateTime $dateOfExpiry;
    public ?string $placeOfBirth;
}
