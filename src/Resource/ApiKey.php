<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class ApiKey extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $status;

    /** @var string */
    public $accessKey;

    /** @var string|null */
    public $name;

    /** @var string|null */
    public $description;

    /** @var string|null */
    public $domain;

    /** @var DateTime|null */
    public $deactivatedAt;

    /** @var User */
    public $owner;
}
