<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Webhook extends BaseResource
{
    use EntityResourceTrait;

    public string $event;
    public string $url;
    public string $status;
}
