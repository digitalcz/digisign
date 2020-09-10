<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\Envelope;

class EnvelopeEmbed
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
    public static function fromArray(array $data): EnvelopeEmbed
    {
        return new EnvelopeEmbed($data['token'], $data['expiresAt']);
    }

    /**
     * @return array<mixed>
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
}
