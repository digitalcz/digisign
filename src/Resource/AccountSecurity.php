<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class AccountSecurity extends BaseResource
{
    use EntityResourceTrait;

    /** @var bool */
    public $reuseRecipientAuthentication;
}
