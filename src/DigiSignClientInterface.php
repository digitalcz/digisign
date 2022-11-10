<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use Psr\Http\Message\ResponseInterface;

interface DigiSignClientInterface
{
    /**
     * @param mixed[] $options
     */
    public function request(string $method, string $uri, array $options = []): ResponseInterface;
}
