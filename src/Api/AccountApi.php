<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Request\Account\AccountGetRequest;
use DigitalCz\DigiSign\Response\Account\AccountGetResponse;
use DigitalCz\DigiSign\ValueObject\Account;

class AccountApi extends BaseApi
{

    public function getAccount(): Account
    {
        $httpRequest = (new AccountGetRequest($this->httpRequestFactory, $this->httpStreamFactory))();
        $httpResponse = $this->client->request($httpRequest);

        return (new AccountGetResponse($httpResponse))();
    }
}
