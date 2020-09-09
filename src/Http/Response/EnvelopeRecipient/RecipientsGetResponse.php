<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\EnvelopeRecipient;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeRecipient\EnvelopeRecipientList;
use Psr\Http\Message\ResponseInterface;

class RecipientsGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeRecipientList
    {
        $this->handleResponseCode($response);

        return EnvelopeRecipientList::fromArray($this->parseResponseBody($response));
    }
}
