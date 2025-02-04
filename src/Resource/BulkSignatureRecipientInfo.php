<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class BulkSignatureRecipientInfo extends BaseResource
{
    public string $name;

    public string $alias;

    public string $email;

    public int $count;

    public bool $isBulkSignable;
}
