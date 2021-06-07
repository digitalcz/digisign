<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class WebhookAttempt extends BaseResource
{
    public string $id;
    public DateTime $createdAt;
    public string $status;
    public string $request;
    public string $response;
    public EntityEvent $event;
}
