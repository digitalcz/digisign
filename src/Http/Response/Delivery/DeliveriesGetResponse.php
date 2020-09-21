<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Delivery;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\Delivery\DeliveryList;
use Psr\Http\Message\ResponseInterface;

class DeliveriesGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): DeliveryList
    {
        $this->handleResponseCode($response);

        return DeliveryList::fromArray($this->parseResponseBody($response));
    }
}
