<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

final class UserBulkSignEnvelope extends BaseResource
{
    public string $id;
    public string $name;

    /** @var string[] */
    public ?array $notSortedReason;
}
