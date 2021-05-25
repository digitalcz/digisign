<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Envelope extends BaseResource
{
    use EntityResourceTrait;

    public string $status;
    public ?string $metadata;
    public string $emailSubject;
    public string $emailBody;
    public ?string $senderName;
    public ?string $senderEmail;
    public int $expiration;
    public string $signatureType;
    public string $authenticationOnOpen;
    public string $authenticationOnSignature;
    public string $authenticationOnDownload;
    public string $language;
    public string $channelForSigner;
    public string $channelForDownload;
    public ?DateTime $validTo;
    public ?DateTime $sentAt;
    public ?DateTime $completedAt;
    public ?DateTime $cancelledAt;
    public ?DateTime $expiredAt;
    public ?DateTime $declinedAt;

    /** @var Collection<EnvelopeRecipient> */
    public Collection $recipients;

    /** @var Collection<EnvelopeDocument> */
    public Collection $documents;

    /** @var Collection<EnvelopeNotification> */
    public Collection $notifications;
}
