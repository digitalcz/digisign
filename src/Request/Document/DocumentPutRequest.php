<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Document;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use DigitalCz\DigiSign\ValueObject\Request\Document;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class DocumentPutRequest extends BaseHttpRequest
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
    /**
     * @var string
     */
    private $documentId;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        Document $document,
        string $documentId
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->document = $document;
        $this->documentId = $documentId;
    }

    public function __invoke(): RequestInterface
    {
        $uri = 'https://digisign.digital.cz/api/documents/%s';

        return $this->requestFactory->createRequest('PUT', sprintf($uri, $this->documentId))
            ->withBody($this->streamFactory->createStream($this->encodeJsonBody($this->document->toArray())))
            ->withHeader('Content-Type', 'application/json');
    }
}
