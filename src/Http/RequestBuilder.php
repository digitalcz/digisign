<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http;

use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class RequestBuilder
{

    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;
    /**
     * @var TokenResolver
     */
    private $tokenResolver;
    /**
     * @var UriResolver
     */
    private $uriResolver;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        TokenResolver $tokenResolver,
        UriResolver $uriResolver
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->tokenResolver = $tokenResolver;
        $this->uriResolver = $uriResolver;
    }

    public function getRequestFactory(): RequestFactoryInterface
    {
        return $this->requestFactory;
    }

    public function getStreamFactory(): StreamFactoryInterface
    {
        return $this->streamFactory;
    }

    public function getTokenResolver(): TokenResolver
    {
        return $this->tokenResolver;
    }

    public function getUriResolver(): UriResolver
    {
        return $this->uriResolver;
    }
}
