<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\DigiSign;

/**
 * Use this if you already have the auth Token
 */
final class TokenCredentials implements Credentials
{
    private Token $token;

    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    public function getHash(): string
    {
        return md5($this->token->getToken() . $this->token->getExp());
    }

    public function provide(DigiSign $digiSign): Token
    {
        return $this->token;
    }

    public function getToken(): Token
    {
        return $this->token;
    }
}
