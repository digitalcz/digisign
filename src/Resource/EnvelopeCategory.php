<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

final class EnvelopeCategory extends BaseResource
{
    public string $id;
    public string $name;
    public ?string $slug;
}
