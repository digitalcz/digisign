<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\EnvelopeDocument;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeDocument;
use Psr\Http\Message\ResponseInterface;

class DocumentResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeDocument
    {
        $this->handleResponseCode($response);

        return EnvelopeDocument::fromArray($this->parseResponseBody($response));
    }
}
