<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response;

use DigitalCz\DigiSign\ValueObject\AuthToken;
use Psr\Http\Message\ResponseInterface;

class AuthTokenPostResponse extends BaseHttpResponse implements HttpResponseInterface
{

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getContents(): string
    {
        return $this->response->getBody()->getContents();
    }

    public function getContentsToArray(): array
    {
        return $this->parseBody($this->response);
    }

    public function getContentsToObject(): AuthToken
    {
        return AuthToken::fromArray($this->getContentsToArray());
    }
}
