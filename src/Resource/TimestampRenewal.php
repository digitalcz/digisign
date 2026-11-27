<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class TimestampRenewal extends BaseResource
{
    public string $id;

    public string $type;

    public DateTime $timestampAt;

    public ?Timestamp $timestamp = null;

    public ?EnvelopeDocument $document = null;

    public DateTime $createdAt;
}
