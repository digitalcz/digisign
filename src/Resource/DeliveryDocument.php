<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class DeliveryDocument extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public ?string $metadata = null;

    public File $file;

    public int $position;
}
