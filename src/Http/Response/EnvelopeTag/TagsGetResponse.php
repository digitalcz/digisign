<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\EnvelopeTag;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeTag\EnvelopeTagList;
use Psr\Http\Message\ResponseInterface;

class TagsGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeTagList
    {
        $this->handleResponseCode($response);

        return EnvelopeTagList::fromArray($this->parseResponseBody($response));
    }
}
