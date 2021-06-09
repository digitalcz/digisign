<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Account extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $status;

    /** @var string */
    public $email;

    /** @var int */
    public $number;

    /** @var AccountSettings */
    public $settings;
}
