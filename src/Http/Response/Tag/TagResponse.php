<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Tag;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\Tag;
use Psr\Http\Message\ResponseInterface;

class TagResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): Tag
    {
        $this->handleResponseCode($response);

        return Tag::fromArray($this->parseResponseBody($response));
    }
}
