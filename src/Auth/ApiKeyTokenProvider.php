<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\DigiSign;
use InvalidArgumentException;

final class ApiKeyTokenProvider implements TokenProvider
{
    private DigiSign $digiSign;

    public function __construct(DigiSign $digiSign)
    {
        $this->digiSign = $digiSign;
    }

    public function provide(Credentials $credentials): Token
    {
        if (!$credentials instanceof ApiKeyCredentials) {
            throw new InvalidArgumentException(
                sprintf('Invalid credentials %s; expected %s', get_class($credentials), ApiKeyCredentials::class),
            );
        }

        $tokenResource = $this->digiSign->auth()->authorize($credentials->toArray());

        return new Token($tokenResource->token, $tokenResource->exp);
    }
}
