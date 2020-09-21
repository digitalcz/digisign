<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\DeliveryDocument;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\DeliveryDocument\DeliveryDocumentList;
use Psr\Http\Message\ResponseInterface;

class DeliveryDocumentsGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): DeliveryDocumentList
    {
        $this->handleResponseCode($response);

        return DeliveryDocumentList::fromArray($this->parseResponseBody($response));
    }
}
