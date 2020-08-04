<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Document;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class DocumentGetRequest extends BaseHttpRequest
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
    private $documentId;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        string $documentId
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->documentId = $documentId;
    }

    public function __invoke(): RequestInterface
    {
        $uri = 'https://digisign.digital.cz/api/documents/%s';

        return $this->requestFactory->createRequest('GET', sprintf($uri, $this->documentId))
            ->withHeader('Content-Type', 'application/json');
    }
}
