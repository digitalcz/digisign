<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Response\Account;

use DigitalCz\DigiSign\Response\BaseHttpResponse;
use DigitalCz\DigiSign\ValueObject\Response\Account;
use Psr\Http\Message\ResponseInterface;

class AccountGetResponse extends BaseHttpResponse
{

    /**
     * @var ResponseInterface
     */
    private $response;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function __invoke(): Account
    {
        return Account::fromArray($this->parseBody($this->response));
    }
}
