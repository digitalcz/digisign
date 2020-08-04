<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Envelope;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class EnvelopeSendPostRequest extends BaseHttpRequest
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
    private $envelopeId;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        string $envelopeId
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->envelopeId = $envelopeId;
    }

    public function __invoke(): RequestInterface
    {
        $uri = 'https://digisign.digital.cz/api/envelopes/%s/send';

        return $this->requestFactory->createRequest('POST', sprintf($uri, $this->envelopeId))
            ->withHeader('Content-Type', 'application/json');
    }
}
