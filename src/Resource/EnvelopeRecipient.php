<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeRecipient extends BaseResource
{
    use EntityResourceTrait;

    public string $status;

    public ?string $metadata = null;

    public string $role;

    public string $signatureType;

    public string $authenticationOnOpen;

    public string $authenticationOnSignature;

    public string $authenticationOnDownload;

    public string $language;

    public string $channelForSigner;

    public string $channelForDownload;

    public string $name;

    public string $email;

    public ?string $mobile = null;

    public ?string $emailBody = null;

    public ?string $emailBodyCompleted = null;

    public ?DateTime $sentAt = null;

    public ?DateTime $deliveredAt = null;

    public ?DateTime $nonDeliveredAt = null;

    public ?string $nonDeliveryReason = null;

    public ?DateTime $authFailedAt = null;

    public ?DateTime $signedAt = null;

    public ?DateTime $downloadedAt = null;

    public ?DateTime $declinedAt = null;

    public ?string $declineReason = null;

    public ?DateTime $cancelledAt = null;

    /** @var Collection<EnvelopeTag> */
    public Collection $tags;

    public int $signingOrder;

    public string $attachmentsStatus;

    public bool $fromTemplate;

    public ?string $intermediaryName = null;

    public ?string $intermediaryEmail = null;

    /** @var array<string, string> */
    public array $bankIdScopes;

    public ?string $authFailedReason = null;

    public ?string $identificationNumber = null;

    public ?string $address = null;

    public ?string $scenario = null;

    public ?string $identifyScenario = null;

    public ?SignatureScenarioVersionInfo $scenarioVersionInfo = null;

    public ?IdentifyScenarioInfo $identifyScenarioInfo = null;

    public ?IdentificationInfo $identification = null;

    public string $approvalMode;

    public bool $approveDocumentsAtOnce;

    public string $channelForNotifications;

    public bool $signDocumentsAtOnce;
}
