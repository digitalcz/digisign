<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Violations extends BaseResource
{
    public string $title;
    public string $detail;

    /** @var Collection<Violation> */
    public Collection $violations;
}
