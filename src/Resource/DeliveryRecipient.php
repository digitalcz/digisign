<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class DeliveryRecipient extends BaseResource
{
    use EntityResourceTrait;

    public string $status;

    public ?string $metadata = null;

    public string $name;

    public string $email;

    public ?string $mobile = null;

    public ?string $emailBody = null;

    public ?DateTime $sentAt = null;

    public ?DateTime $downloadedAt = null;

    public ?DateTime $nonDeliveredAt = null;

    public ?string $nonDeliveryReason = null;

    public ?DateTime $cancelledAt = null;
}
