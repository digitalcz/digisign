<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class DeliveryDocument extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $name;

    /** @var string|null */
    public $metadata;

    /** @var File */
    public $file;

    /** @var int */
    public $position;
}
