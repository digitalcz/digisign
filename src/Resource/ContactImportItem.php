<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

final class ContactImportItem extends BaseResource
{
    use EntityResourceTrait;

    public ?string $failedMessage;

    public ?DateTime $importedAt;

    public ContactImportRawData $data;

    public string $status;

    /** @var array<Violation> */
    public array $violations;
}
