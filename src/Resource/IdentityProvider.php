<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class IdentityProvider extends BaseResource
{
    use EntityResourceTrait;

    public string $domain;

    public string $issuer;

    public string $tenantId;

    public bool $createUser;

    public bool $syncUser;
}
