<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response\Recipient;

use DigitalCz\DigiSign\Response\BaseHttpResponse;
use DigitalCz\DigiSign\ValueObject\Response\Recipient;
use Psr\Http\Message\ResponseInterface;

class RecipientsGetResponse extends BaseHttpResponse
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
     * @return array<Recipient>|Recipient[]
     */
    public function __invoke(): array
    {
        $items = [];

        foreach ($this->parseBody($this->response) as $value) {
            $items[] = Recipient::fromArray($value);
        }

        return $items;
    }
}
