<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class BatchSendingItem extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public int $itemNumber;

    public ?string $envelope;

    public string $status;

    public ?DateTime $sentAt;

    public ?DateTime $failedAt;

    public ?string $failedMessage;

    /** @var array<BatchSendingItemRecipientRaw>  */
    public array $recipientsRawData;

    /** @var array<Violation>|null */
    public ?array $violations;
}
