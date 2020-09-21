<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\DeliveryDocument;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DeliveryDocumentDeleteRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries/%s/documents/%s';

    public function __invoke(string $deliveryId, string $documentId): RequestInterface
    {
        return $this->createRequestToken('DELETE', sprintf(self::URI, $deliveryId, $documentId));
    }
}
