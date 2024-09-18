<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class BatchSendingItem extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public ?string $envelopeId;

    public string $status;

    public ?DateTime $sentAt;

    public ?DateTime $failedAt;

    public ?string $failedMessage;

    /** @var array<BatchSendingItemRecipientRaw>  */
    public array $recipients;

    /** @var array<Violation>|null */
    public ?array $violations;
}
