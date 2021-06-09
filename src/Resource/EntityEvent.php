<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class EntityEvent extends BaseResource
{
    /** @var string */
    public $id;

    /** @var string */
    public $name;

    /** @var DateTime */
    public $time;

    /** @var DateTime */
    public $createdAt;

    /** @var string */
    public $entityName;

    /** @var string */
    public $entityId;

    /** @var mixed[] */
    public $data;
}
