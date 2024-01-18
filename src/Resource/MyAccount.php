<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class MyAccount extends BaseResource
{
    public string $id;
    public string $name;
    public string $status;
    public bool $active;
    public DateTime $createdAt;
    public ?string $idpDomain;
    public ?string $idpAlias;
    public ?string $shortName;
}
