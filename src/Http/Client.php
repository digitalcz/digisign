<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http;

use DigitalCz\DigiSign\Auth\AuthTokenProviderInterface;
use DigitalCz\DigiSign\Exception\ClientResponseNotSuccess;
use DigitalCz\DigiSign\Request\AuthTokenPostRequest;
use DigitalCz\DigiSign\Response\AuthTokenPostResponse;
use DigitalCz\DigiSign\ValueObject\Credentials;
use Psr\Http\Client\ClientInterface;
use Psr\Http\Message\RequestInterface;
use Psr\Http\Message\ResponseInterface;

final class Client
{

    protected $successHttpCodes = [200, 201, 202, 203, 204, 205];

    /**
     * @var Credentials
     */
    protected $clientCredentials;

    /**
     * @var ClientInterface
     */
    protected $client;

    /**
     * @var AuthTokenProviderInterface
     */
    protected $tokenProvider;

    /**
     * @var RequestFactory
     */
    protected $requestFactory;

    public function __construct(
        Credentials $clientCredentials,
        ClientInterface $client,
        AuthTokenProviderInterface $tokenProvider,
        RequestFactory $requestFactory
    ) {
        $this->clientCredentials = $clientCredentials;
        $this->client = $client;
        $this->tokenProvider = $tokenProvider;
        $this->requestFactory = $requestFactory;
    }

    public function request(RequestInterface $request): ResponseInterface
    {
        $response = $this->doRequest($request);

        $this->checkResponse($response);

        return $response;
    }

    private function doRequest(RequestInterface $request): ResponseInterface
    {
        $accessToken = $this->tokenProvider->getAccessToken($this->clientCredentials);

        if ($accessToken === null) {
            $httpRequestToken = new AuthTokenPostRequest($this->clientCredentials);
            $requestToken = $this->requestFactory->createRequest($httpRequestToken);
            $responseToken = $this->client->sendRequest($requestToken);
            $httpResponseToken = new AuthTokenPostResponse($responseToken);

            $accessToken = $httpResponseToken->getContentsToObject();

            $this->tokenProvider->setAccessToken($this->clientCredentials, $accessToken);
        }

        $request = $request->withHeader('Authorization', 'Bearer ' . $accessToken->getToken());

        return $this->client->sendRequest($request);
    }

    protected function checkResponse(ResponseInterface $response): void
    {
        if (!in_array($response->getStatusCode(), $this->successHttpCodes)) {
            throw new ClientResponseNotSuccess((string)$response->getBody(), $response->getStatusCode());
        }
    }
}