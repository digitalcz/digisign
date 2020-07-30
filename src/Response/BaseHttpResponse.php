<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response;

use DigitalCz\DigiSign\Exception\RuntimeException;
use Psr\Http\Message\ResponseInterface;

abstract class BaseHttpResponse
{

    /**
     * @return array<mixed>
     */
    protected function parseBody(ResponseInterface $httpResponse): array
    {
        $body = json_decode((string)$httpResponse->getBody(), true);

        if ($body === false || $body === null) {
            throw new RuntimeException('Failed to parse result json');
        }

        return $body;
    }
}
