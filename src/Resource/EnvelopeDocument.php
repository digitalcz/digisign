<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeDocument extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public ?string $metadata = null;

    public ?File $file;

    /** @var Collection<EnvelopeTag> */
    public Collection $tags;

    /** @var array<string, string> */
    public array $assignments;

    public int $position;

    public bool $signable;

    public bool $fromTemplate;

    public string $labelPositioning;

    public int $labelPositionX;

    public int $labelPositionY;

    public string $signatureValidity;

    public bool $invalidate;

    public ?DateTime $invalidatedAt = null;

    public bool $hasSignatures;

    public bool $timestampEnabled;

    /** Timestamps renewal period in years (-1 = unlimited), null = disabled. */
    public ?int $timestampsRenewalPeriod = null;
}
