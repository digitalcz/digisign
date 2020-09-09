<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Http\Request\AuthTokenPostRequest;
use DigitalCz\DigiSign\Http\Response\AuthTokenPostResponse;
use DigitalCz\DigiSign\Http\UriResolver;
use DigitalCz\DigiSign\Model\Credentials;
use DigitalCz\DigiSign\Model\ValueObject\AuthToken;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class AuthApi
{

    /**
     * @var ClientInterface
     */
    protected $httpClient;
    /**
     * @var RequestFactoryInterface
     */
    private $requestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $streamFactory;
    /**
     * @var UriResolver
     */
    private $uriResolver;

    public function __construct(
        ClientInterface $httpClient,
        RequestFactoryInterface $requestFactory,
        StreamFactoryInterface $streamFactory,
        UriResolver $uriResolver
    ) {
        $this->httpClient = $httpClient;
        $this->requestFactory = $requestFactory;
        $this->streamFactory = $streamFactory;
        $this->uriResolver = $uriResolver;
    }

    public function getAuthToken(Credentials $credentials): AuthToken
    {
        $request =
            (new AuthTokenPostRequest($this->requestFactory, $this->streamFactory, $this->uriResolver))($credentials);

        $httpResponse = $this->httpClient->sendRequest($request);

        return (new AuthTokenPostResponse())($httpResponse);
    }
}
