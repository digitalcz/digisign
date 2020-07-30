<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response;

use DigitalCz\DigiSign\ValueObject\Response\AuthToken;
use Psr\Http\Message\ResponseInterface;

class AuthTokenPostResponse extends BaseHttpResponse
{

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function __invoke(): AuthToken
    {
        return AuthToken::fromArray($this->parseBody($this->response));
    }
}
