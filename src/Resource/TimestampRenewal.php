<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class TimestampRenewal extends BaseResource
{
    public string $id;

    public string $type;

    public string $authority;

    public DateTime $timestampedAt;

    public ?DateTime $nextTimestampAt = null;

    public ?EnvelopeDocument $document = null;

    public ?string $auditLogLanguage = null;

    public DateTime $createdAt;
}
