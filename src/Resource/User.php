<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class User extends BaseResource
{
    use EntityResourceTrait;

    public ?Account $account = null;

    public string $status;

    public string $role;

    public string $email;

    public ?string $mobile = null;

    public ?string $firstName = null;

    public ?string $lastName = null;

    public ?string $position = null;

    public ?DateTime $verifiedAt = null;

    public ?DateTime $deactivatedAt = null;

    public string $note;

    public ?DateTime $lastLoginAt = null;

    public bool $prefillAsRecipient;

    public bool $autoscrollTags;

    public string $userId;

    public bool $hasSignatureImage;
}
