<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Account;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class AccountGetRequest extends BaseHttpRequest
{

    public const URI = '/api/account';

    public function __invoke(): RequestInterface
    {
        return $this->createRequestToken('GET', self::URI);
    }
}
