<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class SignatureScenarioVariant extends BaseResource
{
    use EntityResourceTrait;

    public int $position;

    /** @var array<string, string>|null */
    public ?array $name;

    /** @var array<string, string>|null */
    public ?array $description;
    public string $signatureType;
    public string $authenticationOnOpen;
    public string $authenticationOnSignature;
    public ?string $identifyScenario = null;
    public ?IdentifyScenarioInfo $identifyScenarioInfo = null;
    public bool $signDocumentsAtOnce;
}
