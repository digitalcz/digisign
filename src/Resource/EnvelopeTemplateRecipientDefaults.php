<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplateRecipientDefaults extends BaseResource
{
    use EntityResourceTrait;

    public string $signatureType;

    public string $authenticationOnOpen;

    public string $authenticationOnSignature;

    public string $authenticationOnDownload;

    public string $language;

    public string $channelForSigner;

    public string $channelForDownload;

    /** @var array<string, string> */
    public array $bankIdScopes;

    /** @var array<string, string> */
    public array $visibleFields;

    /** @var array<string, string> */
    public array $validatedFields;

    public bool $delegation;

    public ?string $scenario = null;

    public ?string $identifyScenario = null;

    public ?IdentifyScenarioInfo $identifyScenarioInfo = null;

    public string $approvalMode;

    public bool $approveDocumentsAtOnce;

    public bool $signDocumentsAtOnce;
}
