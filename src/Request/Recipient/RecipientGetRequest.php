<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Recipient;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class RecipientGetRequest extends BaseHttpRequest
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
     * @var string
     */
    private $recipientId;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        string $recipientId
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->recipientId = $recipientId;
    }

    public function __invoke(): RequestInterface
    {
        $uri = 'https://digisign.digital.cz/api/recipients/%s';

        return $this->requestFactory->createRequest('GET', sprintf($uri, $this->recipientId))
            ->withHeader('Content-Type', 'application/json');
    }
}
