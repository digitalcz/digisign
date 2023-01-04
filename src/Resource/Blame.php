<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Blame extends BaseResource
{
    public string $blame;
    public string $id;
    public ?string $name = null;
    public ?string $email = null;
}
