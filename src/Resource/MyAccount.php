<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MyAccount extends BaseResource
{
    public string $id;

    public string $name;

    public string $status;

    public bool $active;

    public ?string $idpDomain;
}
