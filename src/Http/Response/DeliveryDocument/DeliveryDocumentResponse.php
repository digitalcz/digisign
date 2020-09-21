<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\DeliveryDocument;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\DeliveryDocument;
use Psr\Http\Message\ResponseInterface;

class DeliveryDocumentResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): DeliveryDocument
    {
        $this->handleResponseCode($response);

        return DeliveryDocument::fromArray($this->parseResponseBody($response));
    }
}
