<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamInterface;

/**
 * Wrapper class for file response
 */
final class StreamResponse
{
    private ResponseInterface $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getStream(): StreamInterface
    {
        return $this->getResponse()->getBody();
    }
}
