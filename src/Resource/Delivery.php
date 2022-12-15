<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Delivery extends BaseResource
{
    use EntityResourceTrait;

    public string $status;

    public ?string $metadata = null;

    public string $emailSubject;

    public string $emailBody;

    public ?string $senderName = null;

    public ?string $senderEmail = null;

    public ?DateTime $validTo = null;

    public ?DateTime $sentAt = null;

    public ?DateTime $downloadedAt = null;

    public ?DateTime $cancelledAt = null;

    /** @var Collection<DeliveryRecipient> */
    public Collection $recipients;

    /** @var Collection<DeliveryDocument> */
    public Collection $documents;
}
