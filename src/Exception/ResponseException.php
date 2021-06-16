<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Exception;

use DigitalCz\DigiSign\DigiSignClient;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ResponseException extends RuntimeException
{
    /** @var ResponseInterface  */
    private $response;

    public function __construct(
        ResponseInterface $response,
        ?string $message = null,
        ?int $code = null,
        ?Throwable $previous = null
    ) {
        $this->response = $response;
        $code = $code ?? $response->getStatusCode();
        $message = $message ?? sprintf("%s %s", $response->getStatusCode(), $response->getReasonPhrase());

        try {
            $result = $this->parseResult();

            if (isset($result['title'])) {
                $message .= ': ' . $result['title'];
            }

            if (isset($result['detail'])) {
                $message .= ': ' . $result['detail'];
            }
        } catch (RuntimeException $e) {
            $message .= ': ' . $e->getMessage();
        }

        parent::__construct($message, $code, $previous);
    }

    /**
     * Access its underlying response object.
     */
    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    /**
     * @return mixed[]
     */
    protected function parseResult(): array
    {
        $result = DigiSignClient::parseResponse($this->getResponse());

        if ($result === null) {
            throw new EmptyResultException();
        }

        return $result;
    }
}
