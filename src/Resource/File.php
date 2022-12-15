<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class File extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public string $originalName;

    public string $mimeType;

    public int $size;

    public string $sha1Checksum;

    /** @var array<string, mixed> */
    public array $metadata;
}
