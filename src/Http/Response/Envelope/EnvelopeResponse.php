<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Envelope;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\Envelope;
use Psr\Http\Message\ResponseInterface;

class EnvelopeResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): Envelope
    {
        $this->handleResponseCode($response);

        return Envelope::fromArray($this->parseResponseBody($response));
    }
}
