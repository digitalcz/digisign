<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class Timestamp extends BaseResource
{
    public string $id;

    public string $authority;

    public DateTime $createdAt;

    public ?string $createdBy = null;
}
