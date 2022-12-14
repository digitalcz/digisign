<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTimeInterface;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Certificate extends BaseResource
{
    use EntityResourceTrait;

    public string $storage;

    public string $subject;

    public string $issuer;

    public DateTimeInterface $expiresAt;

    public User $owner;

    public string $status;

    public ?string $certificateIdentifier = null;

    public ?string $vaultName = null;

    public ?string $certificateName = null;
}
