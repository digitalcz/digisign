<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Account;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\Account;
use Psr\Http\Message\ResponseInterface;

class AccountGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): Account
    {
        $this->handleResponseCode($response);

        return Account::fromArray($this->parseResponseBody($response));
    }
}
