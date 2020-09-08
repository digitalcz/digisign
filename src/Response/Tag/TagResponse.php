<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response\Tag;

use DigitalCz\DigiSign\Response\BaseHttpResponse;
use DigitalCz\DigiSign\ValueObject\Response\Tag;
use Psr\Http\Message\ResponseInterface;

class TagResponse extends BaseHttpResponse
{
    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function __invoke(): Tag
    {
        return Tag::fromArray($this->parseBody($this->response));
    }
}
