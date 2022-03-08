<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplateDocument extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $name;

    /** @var File */
    public $file;

    /** @var int */
    public $position;

    /** @var string */
    public $labelPositioning;

    /** @var int|null */
    public $labelPositionX;

    /** @var int|null */
    public $labelPositionY;
}
