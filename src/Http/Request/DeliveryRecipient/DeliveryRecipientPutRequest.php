<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\DeliveryRecipient;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\DeliveryRecipientData;
use Psr\Http\Message\RequestInterface;

class DeliveryRecipientPutRequest extends BaseHttpRequest
{
    public const URI = '/api/deliveries/%s/recipients/%s';

    public function __invoke(string $deliveryId, string $documentId, DeliveryRecipientData $document): RequestInterface
    {
        return $this->createRequestToken('PUT', sprintf(self::URI, $deliveryId, $documentId))
            ->withBody(
                $this->createRequestJsonBody($document->toArray())
            );
    }
}
