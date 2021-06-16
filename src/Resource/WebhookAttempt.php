<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class WebhookAttempt extends BaseResource
{
    /** @var string */
    public $id;

    /** @var DateTime */
    public $createdAt;

    /** @var string */
    public $status;

    /** @var string */
    public $request;

    /** @var string */
    public $response;

    /** @var EntityEvent */
    public $event;
}
