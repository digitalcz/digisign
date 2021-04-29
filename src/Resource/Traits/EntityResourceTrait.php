<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource\Traits;

use DateTime;

trait EntityResourceTrait
{
    public string $id;
    public DateTime $createdAt;
    public DateTime $updatedAt;
}
