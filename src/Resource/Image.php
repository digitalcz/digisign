<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Image extends BaseResource
{
    use EntityResourceTrait;

    /** @var bool */
    public $public;

    /** @var string */
    public $name;

    /** @var string */
    public $originalName;

    /** @var string */
    public $mimeType;

    /** @var int */
    public $size;

    /** @var string */
    public $sha1Checksum;
}
