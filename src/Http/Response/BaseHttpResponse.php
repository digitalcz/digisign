<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response;

use DigitalCz\DigiSign\Exception\ClientErrorResponseException;
use DigitalCz\DigiSign\Exception\OtherErrorResponseException;
use DigitalCz\DigiSign\Exception\RuntimeException;
use DigitalCz\DigiSign\Exception\ServerErrorResponseException;
use Psr\Http\Message\ResponseInterface;

abstract class BaseHttpResponse
{

    /**
     * @return array<mixed>
     */
    protected function parseResponseBody(ResponseInterface $httpResponse): array
    {
        $body = json_decode((string)$httpResponse->getBody(), true);

        if ($body === false || $body === null) {
            throw new RuntimeException('Failed to parse result json');
        }

        return $body;
    }

    protected function handleResponseCode(ResponseInterface $response): void
    {
        $statusCode = $response->getStatusCode();

        if ($statusCode >= 200 && $statusCode <= 226) {
            return;
        }

        if ($statusCode >= 400 && $statusCode <= 451) {
            throw new ClientErrorResponseException((string)$response->getBody(), $response->getStatusCode());
        }

        if ($statusCode >= 500 && $statusCode <= 511) {
            throw new ServerErrorResponseException((string)$response->getBody(), $response->getStatusCode());
        } else {
            throw new OtherErrorResponseException((string)$response->getBody(), $response->getStatusCode());
        }
    }
}
