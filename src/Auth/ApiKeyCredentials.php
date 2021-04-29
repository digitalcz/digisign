<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

use DigitalCz\DigiSign\DigiSign;

/**
 * Credentials that are fetched with accessKey/secretKey
 */
final class ApiKeyCredentials implements Credentials
{
    private string $accessKey;
    private string $secretKey;

    public function __construct(string $accessKey, string $secretKey)
    {
        $this->accessKey = $accessKey;
        $this->secretKey = $secretKey;
    }

    public function getAccessKey(): string
    {
        return $this->accessKey;
    }

    public function getSecretKey(): string
    {
        return $this->secretKey;
    }

    public function getHash(): string
    {
        return md5($this->accessKey . $this->secretKey);
    }

    public function provide(DigiSign $digiSign): Token
    {
        $body = ['accessKey' => $this->getAccessKey(), 'secretKey' => $this->getSecretKey()];
        $token = $digiSign->auth()->authorize($body);

        return new Token($token->token, $token->exp);
    }
}
