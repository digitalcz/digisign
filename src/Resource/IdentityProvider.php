<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class IdentityProvider extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $domain;

    /** @var string */
    public $tenantId;
}
