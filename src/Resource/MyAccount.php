<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MyAccount extends BaseResource
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var string */
    public $status;

    /** @var bool */
    public $active;
}
