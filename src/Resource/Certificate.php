<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTimeInterface;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Certificate extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $storage;

    /** @var string */
    public $subject;

    /** @var string */
    public $issuer;

    /** @var DateTimeInterface */
    public $expiresAt;

    /** @var User */
    public $owner;

    /** @var string */
    public $status;

    /** @var string|null */
    public $certificateIdentifier;

    /** @var string|null */
    public $vaultName;

    /** @var string|null */
    public $certificateName;
}
