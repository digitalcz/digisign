<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Request\File\FilePostRequest;
use DigitalCz\DigiSign\Response\File\FilePostResponse;
use DigitalCz\DigiSign\ValueObject\Response\File;
use DigitalCz\DigiSign\ValueObject\Stream;

class FileApi extends BaseApi
{
    public function createFile(Stream $stream): File
    {
        $httpRequest = (new FilePostRequest($this->httpRequestFactory, $this->httpStreamFactory, $stream))();
        $httpResponse = $this->client->request($httpRequest);

        return (new FilePostResponse($httpResponse))();
    }
}
