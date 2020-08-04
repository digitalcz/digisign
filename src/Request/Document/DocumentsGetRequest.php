<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Document;

use DigitalCz\DigiSign\Request\BaseHttpRequest;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\StreamFactoryInterface;

class DocumentsGetRequest extends BaseHttpRequest
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
     * @var int
     */
    private $page;
    /**
     * @var int
     */
    private $itemsPerPage;

    public function __construct(
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        int $page,
        int $itemsPerPage
    ) {
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->page = $page;
        $this->itemsPerPage = $itemsPerPage;
    }

    public function __invoke(): RequestInterface
    {
        $uri = 'https://digisign.digital.cz/api/documents?page=%s&itemsPerPage=%s';

        return $this->requestFactory->createRequest('GET', sprintf($uri, $this->page, $this->itemsPerPage))
            ->withHeader(
                'Content-Type',
                'application/json'
            );
    }
}
