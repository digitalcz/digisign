<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Recipient;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use DigitalCz\DigiSign\ValueObject\Request\Recipient;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class RecipientPutRequest extends BaseHttpRequest
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
    /**
     * @var string
     */
    private $recipientId;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        Recipient $recipient,
        string $recipientId
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->recipient = $recipient;
        $this->recipientId = $recipientId;
    }

    public function __invoke(): RequestInterface
    {
        $uri = 'https://digisign.digital.cz/api/recipients/%s';

        return $this->requestFactory->createRequest('PUT', sprintf($uri, $this->recipientId))
            ->withBody($this->streamFactory->createStream($this->encodeJsonBody($this->recipient->toArray())))
            ->withHeader('Content-Type', 'application/json');
    }
}
