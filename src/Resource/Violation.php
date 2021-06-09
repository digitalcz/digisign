<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Violation extends BaseResource
{
    /** @var string */
    public $propertyPath;

    /** @var string */
    public $title;

    /** @var string[] */
    public $parameters;

    /** @var string */
    public $type;
}
