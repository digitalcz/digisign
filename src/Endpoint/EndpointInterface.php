<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use Psr\Http\Message\ResponseInterface;

interface EndpointInterface
{
    public const METHOD_GET = 'GET';
    public const METHOD_POST = 'POST';
    public const METHOD_PUT = 'PUT';
    public const METHOD_DELETE = 'DELETE';
    public const METHOD_PATCH = 'PATCH';

    /**
     * @param mixed[] $options
     */
    public function request(string $method, string $path = '', array $options = []): ResponseInterface;
}
