<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class DeliveryRecipient extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $status;

    /** @var string|null */
    public $metadata;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string|null */
    public $mobile;

    /** @var string|null */
    public $emailBody;

    /** @var DateTime|null */
    public $sentAt;

    /** @var DateTime|null */
    public $downloadedAt;

    /** @var DateTime|null */
    public $nonDeliveredAt;

    /** @var string|null */
    public $nonDeliveryReason;

    /** @var DateTime|null */
    public $cancelledAt;
}
