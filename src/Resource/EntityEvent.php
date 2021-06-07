<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class EntityEvent extends BaseResource
{
    public string $id;
    public string $name;
    public DateTime $time;
    public DateTime $createdAt;
    public string $entityName;
    public string $entityId;

    /** @var mixed[]  */
    public array $data;
}
