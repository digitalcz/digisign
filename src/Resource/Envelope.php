<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Envelope extends BaseResource
{
    use EntityResourceTrait;

    public string $status;

    public ?string $metadata = null;

    public string $emailSubject;

    public string $emailBody;

    public ?string $emailBodyCompleted = null;

    public ?string $senderName = null;

    public ?string $senderEmail = null;

    public int $expiration;

    public string $signatureType;

    public string $authenticationOnOpen;

    public string $authenticationOnSignature;

    public string $authenticationOnDownload;

    public string $language;

    public string $channelForSigner;

    public string $channelForDownload;

    public ?DateTime $validTo = null;

    public ?DateTime $sentAt = null;

    public ?DateTime $sealedAt = null;

    public ?DateTime $completedAt = null;

    public ?DateTime $cancelledAt = null;

    public ?DateTime $expiredAt = null;

    public ?DateTime $declinedAt = null;

    public ?DateTime $discardedAt = null;

    /** @var Collection<EnvelopeRecipient> */
    public Collection $recipients;

    /** @var Collection<EnvelopeDocument> */
    public Collection $documents;

    /** @var Collection<EnvelopeNotification> */
    public Collection $notifications;

    public bool $sendCompleted;

    public ?string $template = null;

    public EnvelopeProperties $properties;

    /** @var Collection<Label> */
    public Collection $labels;

    public ?Branding $branding = null;

    public ?string $description = null;

    public ?UserInfo $sender = null;
}
