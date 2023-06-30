<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class IdentificationInfo extends BaseResource
{
    public string $id;
    public string $status;
    public ?DateTime $completedAt;
}
