<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\File;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\File;
use Psr\Http\Message\ResponseInterface;

class FilePostResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): File
    {
        $this->handleResponseCode($response);

        return File::fromArray($this->parseResponseBody($response));
    }
}
