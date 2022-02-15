<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeRecipient extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $status;

    /** @var string|null */
    public $metadata;

    /** @var string */
    public $role;

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

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string|null */
    public $mobile;

    /** @var string|null */
    public $emailBody;

    /** @var string|null */
    public $emailBodyCompleted;

    /** @var DateTime|null */
    public $sentAt;

    /** @var DateTime|null */
    public $deliveredAt;

    /** @var DateTime|null */
    public $nonDeliveredAt;

    /** @var string|null */
    public $nonDeliveryReason;

    /** @var DateTime|null */
    public $authFailedAt;

    /** @var DateTime|null */
    public $signedAt;

    /** @var DateTime|null */
    public $downloadedAt;

    /** @var DateTime|null */
    public $declinedAt;

    /** @var string|null */
    public $declineReason;

    /** @var DateTime|null */
    public $cancelledAt;

    /** @var Collection<EnvelopeTag> */
    public $tags;

    /** @var int */
    public $signingOrder;

    /** @var string */
    public $attachmentsStatus;

    /** @var bool */
    public $fromTemplate;

    /** @var string|null */
    public $intermediaryName;

    /** @var string|null */
    public $intermediaryEmail;

    /** @var array<string, string> */
    public $bankIdScopes;
}
