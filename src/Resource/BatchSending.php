<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;


class BatchSending extends BaseResource
{
    use EntityResourceTrait;

    public string $id;

    public ?string $name;

    public ?string $envelopeTemplateId;

    public int $itemsWaitingCount;

    public int $itemsSuccessCount;

    public int $itemsFailedCount;

    public int $itemsTotalCount;

    public string $status;

    /**
     * @var array<BatchSendingSlug>
     */
    public array $slugs;
}
