<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Delivery;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\Delivery;
use Psr\Http\Message\ResponseInterface;

class DeliveryResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): Delivery
    {
        $this->handleResponseCode($response);

        return Delivery::fromArray($this->parseResponseBody($response));
    }
}
