<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Request\Account;

use DigitalCz\DigiSign\Request\HttpRequestInterface;

class AccountGetRequest implements HttpRequestInterface
{

    public function getMethod(): string
    {
        return 'GET';
    }

    public function getUri(): string
    {
        return 'https://digisign.digital.cz/api/account';
    }

    public function getBody(array $data = []): array
    {
        return $data;
    }

    public function getContentType(): string
    {
        return 'application/json';
    }
}
