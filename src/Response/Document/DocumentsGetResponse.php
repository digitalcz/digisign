<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response\Document;

use DigitalCz\DigiSign\Response\BaseHttpResponse;
use DigitalCz\DigiSign\ValueObject\Response\Document;
use Psr\Http\Message\ResponseInterface;

class DocumentsGetResponse extends BaseHttpResponse
{

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    /**
     * @return array<Document>|Document[]
     */
    public function __invoke(): array
    {
        $items = [];

        foreach ($this->parseBody($this->response) as $value) {
            $items[] = Document::fromArray($value);
        }

        return $items;
    }
}
