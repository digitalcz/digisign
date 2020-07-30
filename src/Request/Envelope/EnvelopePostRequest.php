<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Envelope;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use DigitalCz\DigiSign\ValueObject\Request\Envelope;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class EnvelopePostRequest extends BaseHttpRequest
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
     * @var Envelope
     */
    private $envelope;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        Envelope $envelope
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->envelope = $envelope;
    }

    public function __invoke(): RequestInterface
    {
        return $this->requestFactory->createRequest('POST', 'https://digisign.digital.cz/api/envelopes')
            ->withBody(
                $this->streamFactory->createStream($this->encodeJsonBody($this->envelope->toArray()))
            )->withHeader('Content-Type', 'application/json');
    }
}
