<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeRecipient extends BaseResource
{
    use EntityResourceTrait;

    public string $status;
    public ?string $metadata;
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
    public ?string $mobile;
    public ?string $emailBody;
    public ?DateTime $sentAt;
    public ?DateTime $deliveredAt;
    public ?DateTime $nonDeliveredAt;
    public ?string $nonDeliveryReason;
    public ?DateTime $authFailedAt;
    public ?DateTime $signedAt;
    public ?DateTime $downloadedAt;
    public ?DateTime $declinedAt;
    public ?DateTime $cancelledAt;

    /** @var Collection<EnvelopeTag> */
    public Collection $tags;
    public int $signingOrder;
    public string $attachmentsStatus;
}
