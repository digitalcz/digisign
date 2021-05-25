<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class ApiKey extends BaseResource
{
    use EntityResourceTrait;

    public string $status;
    public string $accessKey;
    public ?string $name;
    public ?string $description;
    public ?string $domain;
    public ?DateTime $deactivatedAt;
    public User $owner;
}
