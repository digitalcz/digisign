<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Envelope;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use DigitalCz\DigiSign\ValueObject\Request\Envelope;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class EnvelopePutRequest extends BaseHttpRequest
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
    /**
     * @var string
     */
    private $envelopeId;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        Envelope $envelope,
        string $envelopeId
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->envelope = $envelope;
        $this->envelopeId = $envelopeId;
    }

    public function __invoke(): RequestInterface
    {
        $uri = 'https://digisign.digital.cz/api/envelopes/%s';

        return $this->requestFactory->createRequest('PUT', sprintf($uri, $this->envelopeId))
            ->withBody(
                $this->streamFactory->createStream($this->encodeJsonBody($this->envelope->toArray()))
            )->withHeader('Content-Type', 'application/json');
    }
}
