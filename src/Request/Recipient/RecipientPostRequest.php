<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Recipient;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use DigitalCz\DigiSign\ValueObject\Request\Recipient;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class RecipientPostRequest extends BaseHttpRequest
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
     * @var Recipient
     */
    private $recipient;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        Recipient $recipient
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->recipient = $recipient;
    }

    public function __invoke(): RequestInterface
    {
        return $this->requestFactory->createRequest('POST', 'https://digisign.digital.cz/api/recipients')
            ->withBody($this->streamFactory->createStream($this->encodeJsonBody($this->recipient->toArray())))
            ->withHeader('Content-Type', 'application/json');
    }
}
