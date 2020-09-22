<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\DeliveryRecipient;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DeliveryRecipientGetRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries/%s/recipients/%s';

    public function __invoke(string $deliveryId, string $recipientId): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $deliveryId, $recipientId));
    }
}
