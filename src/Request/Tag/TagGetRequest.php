<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Tag;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class TagGetRequest extends BaseHttpRequest
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

    public function __invoke(string $tagId): RequestInterface
    {
        $uri = 'https://digisign.digital.cz/api/tags/%s';

        return $this->requestFactory->createRequest('GET', sprintf($uri, $tagId))
            ->withHeader('Content-Type', 'application/json');
    }
}
