<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class BatchSendingSlug extends BaseResource
{
    public string $alias;

    /**
     * @var array<int, BatchSendingSlug>
     */
    public array $fields;
}
