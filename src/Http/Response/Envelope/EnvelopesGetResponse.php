<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Envelope;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\Envelope\EnvelopeList;
use Psr\Http\Message\ResponseInterface;

class EnvelopesGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeList
    {
        $this->handleResponseCode($response);

        return EnvelopeList::fromArray($this->parseResponseBody($response));
    }
}
