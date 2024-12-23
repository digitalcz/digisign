<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MyInfo extends BaseResource
{
    public string $email;
    public ?string $firstName;
    public ?string $lastName;

    /** @var string[] */
    public array $permissions;
    public ?MyAccount $account;
    public MyPreferences $preferences;
}
