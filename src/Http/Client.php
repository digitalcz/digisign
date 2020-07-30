<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http;

use DigitalCz\DigiSign\Auth\AuthTokenProviderInterface;
use DigitalCz\DigiSign\Exception\ClientResponseNotSuccess;
use DigitalCz\DigiSign\Request\AuthTokenPostRequest;
use DigitalCz\DigiSign\Response\AuthTokenPostResponse;
use DigitalCz\DigiSign\ValueObject\Credentials;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestFactoryInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\StreamFactoryInterface;

final class Client
{

    /**
     * @var array<int>|int[]
     */
    protected $successHttpCodes = [200, 201, 202, 203, 204, 205];

    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var ClientInterface
     */
    protected $httpClient;

    /**
     * @var RequestFactoryInterface
     */
    private $httpRequestFactory;
    /**
     * @var StreamFactoryInterface
     */
    private $httpStreamFactory;

    /**
     * @var AuthTokenProviderInterface
     */
    protected $tokenProvider;

    public function __construct(
        Credentials $credentials,
        ClientInterface $httpClient,
        RequestFactoryInterface $httpRequestFactory,
        StreamFactoryInterface $httpStreamFactory,
        AuthTokenProviderInterface $tokenProvider
    ) {
        $this->credentials = $credentials;
        $this->httpClient = $httpClient;
        $this->httpRequestFactory = $httpRequestFactory;
        $this->httpStreamFactory = $httpStreamFactory;
        $this->tokenProvider = $tokenProvider;
    }

    public function request(RequestInterface $request): ResponseInterface
    {
        $response = $this->doRequest($request);

        $this->checkResponse($response);

        return $response;
    }

    private function doRequest(RequestInterface $request): ResponseInterface
    {
        $authToken = $this->tokenProvider->getAccessToken($this->credentials);

        if ($authToken === null) {
            $httpRequestToken = (new AuthTokenPostRequest(
                $this->httpRequestFactory,
                $this->httpStreamFactory,
                $this->credentials
            ))();

            $httpResponseToken = $this->httpClient->sendRequest($httpRequestToken);

            $authToken = (new AuthTokenPostResponse($httpResponseToken))();

            $this->tokenProvider->setAccessToken($this->credentials, $authToken);
        }

        $request = $request->withHeader('Authorization', 'Bearer ' . $authToken->getToken());

        return $this->httpClient->sendRequest($request);
    }

    protected function checkResponse(ResponseInterface $response): void
    {
        if (!in_array($response->getStatusCode(), $this->successHttpCodes)) {
            throw new ClientResponseNotSuccess((string)$response->getBody(), $response->getStatusCode());
        }
    }
}
