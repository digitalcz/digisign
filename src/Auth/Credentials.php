<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\DigiSign;

interface Credentials
{
    /**
     * Returns unique hash for every instance of credentials
     */
    public function getHash(): string;

    /**
     * Return auth Token for this credentials
     */
    public function provide(DigiSign $digiSign): Token;
}
