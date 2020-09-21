<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Delivery;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\DeliveryData;
use Psr\Http\Message\RequestInterface;

class DeliveryPutRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries/%s';

    public function __invoke(string $deliveryId, DeliveryData $deliveryData): RequestInterface
    {
        return $this->createRequestToken('PUT', sprintf(self::URI, $deliveryId))
            ->withBody(
                $this->createRequestJsonBody($deliveryData->toArray())
            );
    }
}
