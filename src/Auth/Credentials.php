<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

interface Credentials
{
    /**
     * Returns unique hash for every credentials
     */
    public function getHash(): string;
}
