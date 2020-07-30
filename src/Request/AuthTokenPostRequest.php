<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request;

use DigitalCz\DigiSign\ValueObject\Credentials;

class AuthTokenPostRequest implements HttpRequestInterface
{
    /**
     * @var Credentials
     */
    private $credentials;

    public function __construct(Credentials $credentials)
    {
        $this->credentials = $credentials;
    }

    public function getMethod(): string
    {
        return 'POST';
    }

    public function getUri(): string
    {
        return 'https://digisign.digital.cz/api/auth-token';
    }

    public function getBody(array $data = []): array
    {
        return $this->credentials->toArray();
    }

    public function getContentType(): string
    {
        return 'application/json';
    }
}
