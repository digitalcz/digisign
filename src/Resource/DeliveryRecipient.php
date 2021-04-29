<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class DeliveryRecipient extends BaseResource
{
    use EntityResourceTrait;

    public string $status;
    public ?string $metadata;
    public string $name;
    public string $email;
    public ?string $mobile;
    public ?string $emailBody;
    public ?DateTime $sentAt;
    public ?DateTime $downloadedAt;
    public ?DateTime $nonDeliveredAt;
    public ?string $nonDeliveryReason;
    public ?DateTime $cancelledAt;
}
