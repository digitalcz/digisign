<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

final class UserBulkSignEnvelope extends BaseResource
{
    public string $id;
    public string $name;

    /** @var array<Violation> */
    public array $groupingViolations;
    public string $envelopeId;
    public string $role;
}
