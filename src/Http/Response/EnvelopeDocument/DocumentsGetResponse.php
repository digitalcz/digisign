<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\EnvelopeDocument;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeDocument\EnvelopeDocumentList;
use Psr\Http\Message\ResponseInterface;

class DocumentsGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeDocumentList
    {
        $this->handleResponseCode($response);

        return EnvelopeDocumentList::fromArray($this->parseResponseBody($response));
    }
}
