<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\DeliveryRecipient;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\DeliveryRecipientData;
use Psr\Http\Message\RequestInterface;

class DeliveryRecipientPostRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries/%s/recipients';

    public function __invoke(string $deliveryId, DeliveryRecipientData $recipientData): RequestInterface
    {
        return $this->createRequestToken('POST', sprintf(self::URI, $deliveryId))
            ->withBody(
                $this->createRequestJsonBody($recipientData->toArray())
            );
    }
}
