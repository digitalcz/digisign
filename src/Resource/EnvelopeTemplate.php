<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplate extends BaseResource
{
    use EntityResourceTrait;

    /** @var Collection<EnvelopeTemplateDocument> */
    public Collection $documents;

    /** @var Collection<EnvelopeTemplateRecipient> */
    public Collection $recipients;

    /** @var Collection<EnvelopeTemplateNotification> */
    public Collection $notifications;

    /** @var Collection<EnvelopeTemplateTag> */
    public Collection $tags;

    public string $emailSubject;

    public string $emailBody;

    public ?string $emailBodyCompleted = null;

    public int $expiration;

    public string $signatureType;

    public string $authenticationOnOpen;

    public string $authenticationOnSignature;

    public string $authenticationOnDownload;

    public string $language;

    public string $channelForSigner;

    public string $channelForDownload;

    public bool $timestampDocuments;

    public bool $sendCompleted;

    /** @var array<string> */
    public array $fileCategoriesToConvert;

    /** @var array<string, string> */
    public array $bankIdScopes;

    /** @var array<string, string> */
    public array $visibleFields;

    /** @var array<string, string> */
    public array $validatedFields;

    public bool $useDefaultTemplateSettings;

    /** @var Collection<Label> */
    public Collection $labels;

    public ?Branding $branding = null;

    public ?string $description = null;

    public bool $delegation;

    public ?string $scenario = null;

    public ?string $identifyScenario = null;

    public ?IdentifyScenarioInfo $identifyScenarioInfo = null;

    public ?EnvelopeTemplateRecipientDefaults $signerDefaults = null;

    public ?EnvelopeTemplateRecipientDefaults $approverDefaults = null;

    public ?EnvelopeTemplateRecipientDefaults $ccDefaults = null;
}
