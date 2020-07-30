<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http;

use DigitalCz\DigiSign\Exception\RuntimeException;
use DigitalCz\DigiSign\Request\HttpRequestInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;
use Psr\Http\Message\StreamInterface;

class RequestFactory
{
    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;

    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    public function __construct(RequestFactoryInterface $requestFactory, StreamFactoryInterface $streamFactory)
    {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    public function createRequest(HttpRequestInterface $request): RequestInterface
    {
        return $this->requestFactory->createRequest($request->getMethod(), $request->getUri())
            ->withBody($this->encodeJsonBody($request->getBody()))
            ->withHeader('Content-Type', $request->getContentType());
    }

    /**
     * @param array<mixed> $data
     */
    private function encodeJsonBody(array $data): StreamInterface
    {
        $content = json_encode($data);

        if ($content === false) {
            throw new RuntimeException('Json encoding failure');
        }

        return $this->streamFactory->createStream($content);
    }

    /**
     * @param array<mixed> $data
     */
    private function encodeHttpBody(array $data): StreamInterface
    {
        $content = http_build_query($data);

        return $this->streamFactory->createStream($content);
    }
}