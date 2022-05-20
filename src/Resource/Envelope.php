<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Envelope extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $status;

    /** @var string|null */
    public $metadata;

    /** @var string */
    public $emailSubject;

    /** @var string */
    public $emailBody;

    /** @var string|null */
    public $emailBodyCompleted;

    /** @var string|null */
    public $senderName;

    /** @var string|null */
    public $senderEmail;

    /** @var int */
    public $expiration;

    /** @var string */
    public $signatureType;

    /** @var string */
    public $authenticationOnOpen;

    /** @var string */
    public $authenticationOnSignature;

    /** @var string */
    public $authenticationOnDownload;

    /** @var string */
    public $language;

    /** @var string */
    public $channelForSigner;

    /** @var string */
    public $channelForDownload;

    /** @var DateTime|null */
    public $validTo;

    /** @var DateTime|null */
    public $sentAt;

    /** @var DateTime|null */
    public $sealedAt;

    /** @var DateTime|null */
    public $completedAt;

    /** @var DateTime|null */
    public $cancelledAt;

    /** @var DateTime|null */
    public $expiredAt;

    /** @var DateTime|null */
    public $declinedAt;

    /** @var DateTime|null */
    public $discardedAt;

    /** @var Collection<EnvelopeRecipient> */
    public $recipients;

    /** @var Collection<EnvelopeDocument> */
    public $documents;

    /** @var Collection<EnvelopeNotification> */
    public $notifications;

    /** @var bool */
    public $sendCompleted;

    /** @var string|null */
    public $template;

    /** @var EnvelopeProperties */
    public $properties;

    /** @var Collection<Label> */
    public $labels;

    /** @var Branding|null */
    public $branding;
}
