<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Delivery extends BaseResource
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
    public $senderName;

    /** @var string|null */
    public $senderEmail;

    /** @var DateTime|null */
    public $validTo;

    /** @var DateTime|null */
    public $sentAt;

    /** @var DateTime|null */
    public $downloadedAt;

    /** @var DateTime|null */
    public $cancelledAt;

    /** @var Collection<DeliveryRecipient> */
    public $recipients;

    /** @var Collection<DeliveryDocument> */
    public $documents;
}
