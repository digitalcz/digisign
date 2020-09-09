<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request;

use DigitalCz\DigiSign\Exception\RuntimeException;
use DigitalCz\DigiSign\Http\UriResolver;
use DigitalCz\DigiSign\Model\Credentials;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class AuthTokenPostRequest
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
     * @var UriResolver
     */
    private $uriResolver;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        UriResolver $uriResolver
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->uriResolver = $uriResolver;
    }

    public function __invoke(Credentials $credentials): RequestInterface
    {
        $content = json_encode($credentials->toArray());

        if ($content === false) {
            throw new RuntimeException('Json encoding failure');
        }

        $body = $this->streamFactory->createStream($content);

        return $this->requestFactory
            ->createRequest('POST', sprintf('%s/api/auth-token', $this->uriResolver->getBaseUri()))
            ->withHeader('Content-Type', 'application/json')
            ->withBody($body);
    }
}
