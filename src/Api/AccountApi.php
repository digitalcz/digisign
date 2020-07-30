<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Http\Client;
use DigitalCz\DigiSign\Request\Account\AccountGetRequest;
use DigitalCz\DigiSign\Response\Account\AccountGetResponse;
use DigitalCz\DigiSign\ValueObject\Account;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

class AccountApi
{

    /**
     * @var Client
     */
    private $client;
    /**
     * @var RequestFactoryInterface
     */
    private $httpRequestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $httpStreamFactory;

    public function __construct(
        Client $client,
        RequestFactoryInterface $httpRequestFactory,
        StreamFactoryInterface $httpStreamFactory
    ) {
        $this->client = $client;
        $this->httpRequestFactory = $httpRequestFactory;
        $this->httpStreamFactory = $httpStreamFactory;
    }

    public function getAccount(): Account
    {
        $httpRequest = (new AccountGetRequest($this->httpRequestFactory, $this->httpStreamFactory))();
        $httpResponse = $this->client->request($httpRequest);

        return (new AccountGetResponse($httpResponse))();
    }
}
