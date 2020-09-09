<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\EnvelopeRecipient;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeRecipient;
use Psr\Http\Message\ResponseInterface;

class RecipientResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeRecipient
    {
        return EnvelopeRecipient::fromArray($this->parseResponseBody($response));
    }
}
