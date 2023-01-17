<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class UserInfo extends BaseResource
{
    public string $id;

    public string $email;

    public ?string $mobile = null;

    public ?string $firstName = null;

    public ?string $lastName = null;
}
