<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

/**
 * @property string $unmapped
 */
class DummyResource extends BaseResource
{
    public bool $bool;
    public string $string;
    public ?string $nullable = null;
    public int $integer;
    public float $float;
    public DummyResource $resource;
    public DateTime $dateTime;

    /** @var Collection<DummyResource> */
    public Collection $collection;
}
