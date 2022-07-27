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
    public $issuer;

    /** @var string */
    public $tenantId;

    /** @var bool */
    public $createUser;

    /** @var bool */
    public $syncUser;
}
