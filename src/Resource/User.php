<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class User extends BaseResource
{
    use EntityResourceTrait;

    public ?Account $account;
    public string $status;
    public string $role;
    public string $email;
    public ?string $mobile;
    public ?string $firstName;
    public ?string $lastName;
    public ?string $position;
    public ?DateTime $verifiedAt;
    public ?DateTime $deactivatedAt;
    public string $note;
    public ?DateTime $lastLoginAt;
}
