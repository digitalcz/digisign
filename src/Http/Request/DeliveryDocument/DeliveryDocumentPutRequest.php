<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\DeliveryDocument;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\DeliveryDocumentData;
use Psr\Http\Message\RequestInterface;

class DeliveryDocumentPutRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries/%s/documents/%s';

    public function __invoke(string $deliveryId, string $documentId, DeliveryDocumentData $document): RequestInterface
    {
        return $this->createRequestToken('PUT', sprintf(self::URI, $deliveryId, $documentId))
            ->withBody(
                $this->createRequestJsonBody($document->toArray())
            );
    }
}
