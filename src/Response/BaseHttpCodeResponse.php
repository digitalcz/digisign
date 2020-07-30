<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response;

use Psr\Http\Message\ResponseInterface;

abstract class BaseHttpCodeResponse extends BaseHttpResponse
{

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function __invoke(): int
    {
        return $this->response->getStatusCode();
    }
}
