<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request;

use DigitalCz\DigiSign\Exception\RuntimeException;
use DigitalCz\DigiSign\Http\RequestBuilder;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamInterface;

abstract class BaseHttpRequest
{

    /**
     * @var RequestBuilder
     */
    protected $requestBuilder;

    public function __construct(RequestBuilder $requestBuilder)
    {
        $this->requestBuilder = $requestBuilder;
    }

    protected function createRequestToken(string $method, string $uri): RequestInterface
    {
        $uri = $this->requestBuilder->getUriResolver()->getCompleteUri($uri);

        $authToken = $this->requestBuilder->getTokenResolver()->resolve();
        $tokenHeader = sprintf('Bearer %s', $authToken->getToken());

        return $this->requestBuilder->getRequestFactory()
            ->createRequest($method, $uri)
            ->withHeader('Authorization', $tokenHeader)
            ->withHeader('Content-Type', 'application/json');
    }

    /**
     * @param array<mixed> $data
     */
    protected function createRequestJsonBody(array $data): StreamInterface
    {
        return $this->requestBuilder->getStreamFactory()->createStream($this->encodeJsonBody($data));
    }

    /**
     * @param array<mixed> $data
     */
    protected function encodeJsonBody(array $data): string
    {
        $content = json_encode($data);

        if ($content === false) {
            throw new RuntimeException('Json encoding failure');
        }

        return $content;
    }

    /**
     * @param array<mixed> $data
     */
    protected function encodeHttpBody(array $data): string
    {
        return http_build_query($data);
    }
}
