<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Delivery;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DeliveryCancelPostRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries/%s/cancel';

    public function __invoke(string $deliveryId): RequestInterface
    {
        return $this->createRequestToken('POST', sprintf(self::URI, $deliveryId));
    }
}
