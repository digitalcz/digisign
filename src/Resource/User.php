<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class User extends BaseResource
{
    use EntityResourceTrait;

    /** @var Account|null */
    public $account;

    /** @var string */
    public $status;

    /** @var string */
    public $role;

    /** @var string */
    public $email;

    /** @var string|null */
    public $mobile;

    /** @var string|null */
    public $firstName;

    /** @var string|null */
    public $lastName;

    /** @var string|null */
    public $position;

    /** @var DateTime|null */
    public $verifiedAt;

    /** @var DateTime|null */
    public $deactivatedAt;

    /** @var string */
    public $note;

    /** @var DateTime|null */
    public $lastLoginAt;

    /** @var bool */
    public $prefillAsRecipient;

    /** @var bool */
    public $autoscrollTags;
}
