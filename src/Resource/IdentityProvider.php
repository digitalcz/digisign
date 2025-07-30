<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class IdentityProvider extends BaseResource
{
    use EntityResourceTrait;

    public string $type;

    public string $domain;

    public ?string $alias;

    public string $issuer;

    public ?string $clientId;

    public ?string $scopes;

    public bool $createUser;

    public bool $syncUser;

    public bool $usingGroups;

    public ?string $groupPattern;

    public string $tenantId;
}
