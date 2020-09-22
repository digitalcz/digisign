<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\DeliveryRecipient;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\DeliveryRecipient;
use Psr\Http\Message\ResponseInterface;

class DeliveryRecipientResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): DeliveryRecipient
    {
        $this->handleResponseCode($response);

        return DeliveryRecipient::fromArray($this->parseResponseBody($response));
    }
}
