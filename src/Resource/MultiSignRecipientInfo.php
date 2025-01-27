<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MultiSignRecipientInfo extends BaseResource
{
    public string $name;

    public string $alias;

    public string $email;

    public int $count;

    public bool $isMultiSignable;
}
