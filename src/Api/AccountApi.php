<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Http\Client;
use DigitalCz\DigiSign\Http\RequestFactory;
use DigitalCz\DigiSign\Request\Account\AccountGetRequest;
use DigitalCz\DigiSign\Response\Account\AccountGetResponse;
use DigitalCz\DigiSign\ValueObject\Account;

class AccountApi
{

    /**
     * @var Client
     */
    private $client;
    /**
     * @var RequestFactory
     */
    private $requestFactory;

    public function __construct(Client $client, RequestFactory $requestFactory)
    {
        $this->client = $client;
        $this->requestFactory = $requestFactory;
    }

    public function getAccount(): Account
    {
        $httpRequest = new AccountGetRequest();

        $request = $this->requestFactory->createRequest($httpRequest);
        $response = $this->client->request($request);

        return (new AccountGetResponse($response))();
    }
}
