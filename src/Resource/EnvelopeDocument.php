<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeDocument extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $name;

    /** @var string|null */
    public $metadata;

    /** @var File */
    public $file;

    /** @var Collection<EnvelopeTag> */
    public $tags;

    /** @var int */
    public $position;

    /** @var bool */
    public $signable;

    /** @var bool */
    public $fromTemplate;

    /** @var string|null */
    public $labelPositioning;

    /** @var int|null */
    public $labelPositionX;

    /** @var int|null */
    public $labelPositionY;
}
