<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Contact extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $name;

    /** @var string */
    public $email;

    /** @var string */
    public $mobile;

    /** @var string */
    public $language;

    /** @var array<string, mixed> */
    public $account;
}
