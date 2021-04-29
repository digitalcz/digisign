<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Violation extends BaseResource
{
    public string $propertyPath;
    public string $title;

    /** @var string[] */
    public array $parameters;
    public string $type;
}
