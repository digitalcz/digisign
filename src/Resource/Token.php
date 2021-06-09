<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Token extends BaseResource
{
    /** @var string */
    public $token;

    /** @var int */
    public $exp;

    /** @var int */
    public $iat;
}
