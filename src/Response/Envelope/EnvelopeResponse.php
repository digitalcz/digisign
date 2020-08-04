<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response\Envelope;

use DigitalCz\DigiSign\Response\BaseHttpResponse;
use DigitalCz\DigiSign\ValueObject\Response\Envelope;
use Psr\Http\Message\ResponseInterface;

class EnvelopeResponse extends BaseHttpResponse
{

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function __invoke(): Envelope
    {
        return Envelope::fromArray($this->parseBody($this->response));
    }
}
