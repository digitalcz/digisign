<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Delivery;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DeliverySendPostRequest extends BaseHttpRequest
{

    public const URI = '/api/deliveries/%s/send';

    public function __invoke(string $deliveryId): RequestInterface
    {
        return $this->createRequestToken('POST', sprintf(self::URI, $deliveryId));
    }
}
