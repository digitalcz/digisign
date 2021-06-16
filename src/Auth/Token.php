<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

/**
 * @codeCoverageIgnore
 */
final class Token
{
    /** @var string  */
    private $token;

    /** @var int  */
    private $exp;

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
