<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Http\RequestBuilder;
use Psr\Http\Client\ClientInterface;

abstract class BaseApi
{

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var RequestBuilder
     */
    protected $requestBuilder;

    public function __construct(ClientInterface $client, RequestBuilder $requestBuilder)
    {
        $this->client = $client;
        $this->requestBuilder = $requestBuilder;
    }
}
