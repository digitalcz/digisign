<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Delivery extends BaseResource
{
    use EntityResourceTrait;

    public string $status;
    public ?string $metadata;
    public string $emailSubject;
    public string $emailBody;
    public ?string $senderName;
    public ?string $senderEmail;
    public ?DateTime $validTo;
    public ?DateTime $sentAt;
    public ?DateTime $downloadedAt;
    public ?DateTime $cancelledAt;

    /** @var Collection<DeliveryRecipient> */
    public Collection $recipients;

    /** @var Collection<DeliveryDocument> */
    public Collection $documents;
}
