<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class NotificationChannels extends BaseResource
{
    use EntityResourceTrait;

    public string $declined;

    public string $disapproved;

    public string $expired;

    public string $authFailed;

    public string $deliveryFailed;

    public string $identificationDenied;

    public string $deleted;

    public string $cancelled;
}
