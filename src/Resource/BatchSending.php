<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class BatchSending extends BaseResource
{
    use EntityResourceTrait;

    public Blame $createdBy;

    public ?string $name;

    public ?EnvelopeTemplateInfo $envelopeTemplateInfo;

    public ?UserInfo $owner;

    public ?File $file;

    public int $itemsWaitingCount;

    public int $itemsSuccessCount;

    public int $itemsFailedCount;

    public int $itemsTotalCount;

    public string $status;

    /**
     * @var array<string, array<string>>
     */
    public array $importFields;

    public ?DateTime $sentAt;

    public ?DateTime $finishedAt;

    public ?Blame $sentBy;
}
