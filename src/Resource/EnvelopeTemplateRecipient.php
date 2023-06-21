<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplateRecipient extends BaseResource
{
    use EntityResourceTrait;

    public string $alias;

    public string $role;

    public string $signatureType;

    public string $authenticationOnOpen;

    public string $authenticationOnSignature;

    public string $authenticationOnDownload;

    public ?string $name = null;

    public ?string $email = null;

    public ?string $mobile = null;

    public ?string $emailBody = null;

    public ?string $emailBodyCompleted = null;

    public string $language;

    public string $channelForSigner;

    public string $channelForDownload;

    public int $signingOrder;

    public ?string $intermediaryName = null;

    public ?string $intermediaryEmail = null;

    public string $prefill;

    /** @var array<string, string> */
    public array $bankIdScopes;

    public ?string $identificationNumber = null;

    public ?string $address = null;

    public ?SignatureScenarioVersionInfo $signatureScenarioVersionInfo = null;

    public ?IdentifyScenarioVersionInfo $identifyScenarioVersionInfo = null;
}
