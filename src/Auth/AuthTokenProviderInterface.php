<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\ValueObject\Credentials;
use DigitalCz\DigiSign\ValueObject\AuthToken;

interface AuthTokenProviderInterface
{
    public function getAccessToken(Credentials $credentials): ?AuthToken;

    public function setAccessToken(Credentials $credentials, AuthToken $authToken): void;
}
