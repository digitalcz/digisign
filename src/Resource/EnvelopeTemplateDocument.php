<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplateDocument extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public File $file;

    public int $position;

    public string $labelPositioning;

    public ?int $labelPositionX = null;

    public ?int $labelPositionY = null;

    /** @var array<string, string> */
    public array $assignments;

    public bool $timestampEnabled;

    public ?int $timestampsRenewalPeriod = null;
}
