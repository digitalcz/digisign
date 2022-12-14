<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeDocument extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public ?string $metadata = null;

    public File $file;

    /** @var Collection<EnvelopeTag> */
    public Collection $tags;

    public int $position;

    public bool $signable;

    public bool $fromTemplate;

    public string $labelPositioning;

    public int $labelPositionX;

    public int $labelPositionY;

    public string $signatureValidity;
}
