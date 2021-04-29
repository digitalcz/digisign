<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Exception;

use DigitalCz\DigiSign\DigiSignClient;
use Psr\Http\Message\ResponseInterface;
use Throwable;

class ResponseException extends RuntimeException
{
    private ResponseInterface $response;

    public function __construct(
        ResponseInterface $response,
        ?string $message = null,
        ?int $code = null,
        ?Throwable $previous = null
    ) {
        $code ??= $response->getStatusCode();
        $message ??= sprintf("%s (%s)", $response->getReasonPhrase(), $response->getStatusCode());

        try {
            $result = $this->parseResult();

            if (isset($result['title'])) {
                $message .= ' ' . $result['title'];
            }

            if (isset($result['detail'])) {
                $message .= ' ' . $result['detail'];
            }
        } catch (Throwable $e) {
            $message .= ' ' . $e->getMessage();
        }

        parent::__construct($message, $code, $previous);

        $this->response = $response;
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
