<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response\Envelope;

use DigitalCz\DigiSign\Response\BaseHttpResponse;
use DigitalCz\DigiSign\ValueObject\Response\Envelope;
use Psr\Http\Message\ResponseInterface;

class EnvelopesGetResponse extends BaseHttpResponse
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
     * @return array<Envelope>|Envelope[]
     */
    public function __invoke(): array
    {
        $items = [];

        foreach ($this->parseBody($this->response) as $value) {
            $items[] = Envelope::fromArray($value);
        }

        return $items;
    }
}
