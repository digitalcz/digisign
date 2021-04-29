<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Auth;

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

    /**
     * @return array{accessKey: string, secretKey: string}
     */
    public function toArray(): array
    {
        return ['accessKey' => $this->accessKey, 'secretKey' => $this->secretKey];
    }
}
