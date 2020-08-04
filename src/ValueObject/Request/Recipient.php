<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject\Request;

class Recipient
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $role;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
     */
    private $mobile;
    /**
     * @var string
     */
    private $envelope;
    /**
     * @var string|null
     */
    private $metadata;
    /**
     * @var string|null
     */
    private $emailBody;

    public function __construct(
        string $name,
        string $role,
        string $email,
        string $mobile,
        string $envelope,
        ?string $metadata = null,
        ?string $emailBody = null
    ) {
        $this->name = $name;
        $this->role = $role;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->envelope = $envelope;
        $this->metadata = $metadata;
        $this->emailBody = $emailBody;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['role'],
            $data['email'],
            $data['mobile'],
            $data['envelope'],
            $data['metadata'],
            $data['emailBody']
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'role' => $this->role,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'envelope' => $this->envelope,
            'metadata' => $this->metadata,
            'emailBody' => $this->emailBody,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function getEnvelope(): string
    {
        return $this->envelope;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function getEmailBody(): ?string
    {
        return $this->emailBody;
    }
}
