<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

class AuthToken
{
    /**
     * @var string
     */
    private $token;

    /**
     * @var int
     */
    private $expiresAt;


    public function __construct(string $token, int $expiresAt)
    {
        $this->token = $token;
        $this->expiresAt = $expiresAt;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['token'],
            $data['expiresAt']
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'token' => $this->token,
            'expiresAt' => $this->expiresAt,
        ];
    }

    public function getToken(): string
    {
        return $this->token;
    }

    public function getExpiresAt(): int
    {
        return $this->expiresAt;
    }

    public function getTtl(): int
    {
        $ttl = $this->expiresAt - time();

        if ($ttl < 0) {
            return 0;
        }

        return $ttl;
    }
}
