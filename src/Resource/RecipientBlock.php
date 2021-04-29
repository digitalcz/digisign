<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class RecipientBlock extends BaseResource
{
    public string $address;
    public int $code;
    public string $error;
    public DateTime $createdAt;
}
