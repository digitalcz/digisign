<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\Model\Credentials;
use DigitalCz\DigiSign\Model\ValueObject\AuthToken;

interface AuthTokenProviderInterface
{
    public function getAccessToken(Credentials $credentials): ?AuthToken;

    public function setAccessToken(Credentials $credentials, AuthToken $authToken): void;
}
