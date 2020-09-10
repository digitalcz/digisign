<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Envelope;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\Envelope\EnvelopeEmbed;
use Psr\Http\Message\ResponseInterface;

class EnvelopeEmbedPostResponse extends BaseHttpResponse
{
    public function __invoke(ResponseInterface $response): EnvelopeEmbed
    {
        $this->handleResponseCode($response);

        return EnvelopeEmbed::fromArray($this->parseResponseBody($response));
    }
}
