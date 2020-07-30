<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response\Recipient;

use DigitalCz\DigiSign\Response\BaseHttpResponse;
use DigitalCz\DigiSign\ValueObject\Response\Recipient;
use Psr\Http\Message\ResponseInterface;

class RecipientResponse extends BaseHttpResponse
{

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function __invoke(): Recipient
    {
        return Recipient::fromArray($this->parseBody($this->response));
    }
}
