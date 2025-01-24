<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

final class MultiSign extends BaseResource
{
    use EntityResourceTrait;

    public ?string $alias;

    public string $name;

    public string $email;

    public ?string $mobile;

    public ?DateTime $birthdate;

    public ?string $birthnumber;

    public string $role;

    public string $signatureType;

    public string $authenticationOnOpen;

    public string $authenticationOnSignature;

    public string $status;

    public ?SignatureScenarioVersion $scenarioVersion;

    /**
     * @var string[]
     */
    public array $visibleFields;

    public ?DateTime $sentAt;

    public ?DateTime $deliveredAt;

    public ?DateTime $validTo;

    public ?DateTime $expiredAt;

    public int $expiration;

    public ?User $sender;

    public ?string $emailBody;

    public string $language;

    public ?Branding $branding;
}
