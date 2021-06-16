<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class RecipientBlock extends BaseResource
{
    /** @var string */
    public $address;

    /** @var int */
    public $code;

    /** @var string */
    public $error;

    /** @var DateTime */
    public $createdAt;
}
