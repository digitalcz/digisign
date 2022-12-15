<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Token extends BaseResource
{
    public string $token;

    public int $exp;

    public int $iat;
}
