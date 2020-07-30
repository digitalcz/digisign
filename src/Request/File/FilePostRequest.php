<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\File;

use DigitalCz\DigiSign\Request\HttpRequestInterface;

class FilePostRequest implements HttpRequestInterface
{

    public function getMethod(): string
    {
        // TODO: Implement getMethod() method.
    }

    public function getUri(): string
    {
        // TODO: Implement getUri() method.
    }

    public function getBody(array $data = []): array
    {
        // TODO: Implement getBody() method.
    }

    public function getContentType(): string
    {
        // TODO: Implement getContentType() method.
    }
}