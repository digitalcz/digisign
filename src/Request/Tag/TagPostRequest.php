<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Tag;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use DigitalCz\DigiSign\ValueObject\Request\Tag;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class TagPostRequest extends BaseHttpRequest
{
    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
    }

    public function __invoke(Tag $tag): RequestInterface
    {
        return $this->requestFactory->createRequest('POST', 'https://api.digisign.digital.cz/api/tags')
            ->withBody($this->streamFactory->createStream($this->encodeJsonBody($tag->toArray())))
            ->withHeader('Content-Type', 'application/json');
    }
}
