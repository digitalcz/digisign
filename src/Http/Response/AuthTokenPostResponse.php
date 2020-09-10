<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response;

use DigitalCz\DigiSign\Model\ValueObject\AuthToken;
use Psr\Http\Message\ResponseInterface;

class AuthTokenPostResponse extends BaseHttpResponse
{
    public function __invoke(ResponseInterface $response): AuthToken
    {
        $this->handleResponseCode($response);

        return AuthToken::fromArray($this->parseResponseBody($response));
    }
}
