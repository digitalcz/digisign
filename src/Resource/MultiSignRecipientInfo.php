<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MultiSignRecipientInfo extends BaseResource
{
    public string $recipientName;

    public string $recipientAlias;

    public string $recipientEmail;

    public int $count;

    public bool $isMultiSignable;
}
