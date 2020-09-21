<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\DeliveryDocument;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\DeliveryDocumentData;
use Psr\Http\Message\RequestInterface;

class DeliveryDocumentPostRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries/%s/documents';

    public function __invoke(string $deliveryId, DeliveryDocumentData $document): RequestInterface
    {
        return $this->createRequestToken('POST', sprintf(self::URI, $deliveryId))
            ->withBody(
                $this->createRequestJsonBody($document->toArray())
            );
    }
}
