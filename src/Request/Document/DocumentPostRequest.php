<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Document;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use DigitalCz\DigiSign\ValueObject\Request\Document;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class DocumentPostRequest extends BaseHttpRequest
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
     * @var Document
     */
    private $document;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        Document $document
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->document = $document;
    }

    public function __invoke(): RequestInterface
    {
        return $this->requestFactory->createRequest('POST', 'https://digisign.digital.cz/api/documents')
            ->withBody($this->streamFactory->createStream($this->encodeJsonBody($this->document->toArray())))
            ->withHeader('Content-Type', 'application/json');
    }
}
