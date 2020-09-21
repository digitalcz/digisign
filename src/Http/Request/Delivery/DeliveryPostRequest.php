<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Delivery;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\DeliveryData;
use Psr\Http\Message\RequestInterface;

class DeliveryPostRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries';

    public function __invoke(DeliveryData $deliveryData): RequestInterface
    {
        return $this->createRequestToken('POST', self::URI)
            ->withBody(
                $this->createRequestJsonBody($deliveryData->toArray())
            );
    }
}
