<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

class EnvelopeRecipientData
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
     * @var string|null
     */
    private $mobile;
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
        ?string $mobile = null,
        ?string $metadata = null,
        ?string $emailBody = null
    ) {
        $this->name = $name;
        $this->role = $role;
        $this->email = $email;
        $this->mobile = $mobile;
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
            'metadata' => $this->metadata,
            'emailBody' => $this->emailBody,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function setMobile(?string $mobile): void
    {
        $this->mobile = $mobile;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(?string $metadata): void
    {
        $this->metadata = $metadata;
    }

    public function getEmailBody(): ?string
    {
        return $this->emailBody;
    }

    public function setEmailBody(?string $emailBody): void
    {
        $this->emailBody = $emailBody;
    }
}
