<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Delivery;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DeliveryGetRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries/%s';

    public function __invoke(string $deliveryId): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $deliveryId));
    }
}
