<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource\Traits;

use DateTime;

trait EntityResourceTrait
{
    /** @var string */
    public $id;

    /** @var DateTime */
    public $createdAt;

    /** @var DateTime */
    public $updatedAt;
}
