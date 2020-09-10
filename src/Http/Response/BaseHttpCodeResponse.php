<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response;

use Psr\Http\Message\ResponseInterface;

abstract class BaseHttpCodeResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): int
    {
        return $response->getStatusCode();
    }
}
