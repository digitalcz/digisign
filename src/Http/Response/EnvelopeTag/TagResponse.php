<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\EnvelopeTag;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeTag;
use Psr\Http\Message\ResponseInterface;

class TagResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeTag
    {
        $this->handleResponseCode($response);

        return EnvelopeTag::fromArray($this->parseResponseBody($response));
    }
}
