<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http;

use DigitalCz\DigiSign\Api\AuthApi;
use DigitalCz\DigiSign\Auth\AuthTokenProviderInterface;
use DigitalCz\DigiSign\Model\Credentials;
use DigitalCz\DigiSign\Model\ValueObject\AuthToken;

final class TokenResolver
{

    /**
     * @var AuthApi
     */
    protected $authApi;

    /**
     * @var Credentials
     */
    protected $credentials;

    /**
     * @var AuthTokenProviderInterface
     */
    protected $tokenProvider;

    public function __construct(AuthApi $authApi, Credentials $credentials, AuthTokenProviderInterface $tokenProvider)
    {
        $this->authApi = $authApi;
        $this->credentials = $credentials;
        $this->tokenProvider = $tokenProvider;
    }

    public function resolve(): AuthToken
    {
        $authToken = $this->tokenProvider->getAccessToken($this->credentials);

        if ($authToken === null) {
            $authToken = $this->authApi->getAuthToken($this->credentials);

            $this->tokenProvider->setAccessToken($this->credentials, $authToken);
        }

        return $authToken;
    }
}
