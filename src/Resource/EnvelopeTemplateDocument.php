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
}
