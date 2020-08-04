<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response\Document;

use DigitalCz\DigiSign\Response\BaseHttpResponse;
use DigitalCz\DigiSign\ValueObject\Response\Document;
use Psr\Http\Message\ResponseInterface;

class DocumentResponse extends BaseHttpResponse
{

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function __invoke(): Document
    {
        return Document::fromArray($this->parseBody($this->response));
    }
}
