<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

final class ContactImport extends BaseResource
{
    use EntityResourceTrait;

    public ?string $owner;

    public ?File $file;

    public string $duplicateStrategy;

    public string $status;

    /** @var string[] */
    public array $importedFields;
}
