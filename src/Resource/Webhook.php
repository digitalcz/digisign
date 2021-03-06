<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Webhook extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $event;

    /** @var string */
    public $url;

    /** @var string */
    public $status;

    /** @var string */
    public $secret;
}
