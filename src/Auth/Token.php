<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

final class Token
{
    private string $token;
    private int $exp;

    public function __construct(string $token, int $exp)
    {
        $this->token = $token;
        $this->exp = $exp;
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExp(): int
    {
        return $this->exp;
    }

    public function getTtl(): int
    {
        return $this->getExp() - time();
    }
}
