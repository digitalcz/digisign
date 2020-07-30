<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response\File;

use DigitalCz\DigiSign\Response\BaseHttpResponse;
use DigitalCz\DigiSign\ValueObject\File;
use Psr\Http\Message\ResponseInterface;

class FilePostResponse extends BaseHttpResponse
{

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function __invoke(): File
    {
        return File::fromArray($this->parseBody($this->response));
    }
}
