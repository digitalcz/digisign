<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Http\Request\Account\AccountGetRequest;
use DigitalCz\DigiSign\Http\Response\Account\AccountGetResponse;
use DigitalCz\DigiSign\Model\ValueObject\Account;

class AccountApi extends BaseApi
{

    public function getAccount(): Account
    {
        $httpRequest = (new AccountGetRequest($this->requestBuilder))();
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new AccountGetResponse())($httpResponse);
    }
}
