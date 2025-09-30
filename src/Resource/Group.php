<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Group extends BaseResource
{
    use EntityResourceTrait;

    public string $name;

    public string $description;

    /** @var Collection<User> */
    public Collection $users;
}
