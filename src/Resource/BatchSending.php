<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class BatchSending extends BaseResource
{
    use EntityResourceTrait;

    public ?string $name;

    public ?string $envelopeTemplateId;

    public ?File $file;

    public int $itemsWaitingCount;

    public int $itemsSuccessCount;

    public int $itemsFailedCount;

    public int $itemsTotalCount;

    public string $status;

    /**
     * @var array<string>
     */
    public array $importFields;
}
