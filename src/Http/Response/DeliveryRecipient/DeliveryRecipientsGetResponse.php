<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\DeliveryRecipient;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\DeliveryRecipient\DeliveryRecipientList;
use Psr\Http\Message\ResponseInterface;

class DeliveryRecipientsGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): DeliveryRecipientList
    {
        $this->handleResponseCode($response);

        return DeliveryRecipientList::fromArray($this->parseResponseBody($response));
    }
}
