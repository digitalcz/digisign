<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Http\Request\File\FilePostRequest;
use DigitalCz\DigiSign\Http\Response\File\FilePostResponse;
use DigitalCz\DigiSign\Model\Stream;
use DigitalCz\DigiSign\Model\ValueObject\File;

class FileApi extends BaseApi
{

    public function createFile(Stream $stream): File
    {
        $httpRequest = (new FilePostRequest($this->requestBuilder))($stream);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new FilePostResponse())($httpResponse);
    }
}
