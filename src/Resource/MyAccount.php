<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MyAccount extends BaseResource
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var bool */
    public $active;
}
