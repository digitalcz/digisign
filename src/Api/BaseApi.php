<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Http\Client;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

abstract class BaseApi
{

    /**
     * @var Client
     */
    protected $client;
    /**
     * @var RequestFactoryInterface
     */
    protected $httpRequestFactory;
    /**
     * @var StreamFactoryInterface
     */
    protected $httpStreamFactory;

    public function __construct(
        Client $client,
        RequestFactoryInterface $httpRequestFactory,
        StreamFactoryInterface $httpStreamFactory
    ) {
        $this->client = $client;
        $this->httpRequestFactory = $httpRequestFactory;
        $this->httpStreamFactory = $httpStreamFactory;
    }
}
