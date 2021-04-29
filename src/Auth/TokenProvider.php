<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

interface TokenProvider
{
    public function provide(Credentials $credentials): Token;
}
