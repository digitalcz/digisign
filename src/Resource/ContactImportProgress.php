<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

final class ContactImportProgress extends BaseResource
{
    public string $status;
    public int $iteration;
    public ?int $batchSize;
    public int $totalItems;
    public int $processedItems;
}
