<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

class DeliveryRecipientData
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $email;
    /**
     * @var string
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
        string $email,
        string $mobile,
        ?string $metadata = null,
        ?string $emailBody = null
    ) {
        $this->name = $name;
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

    public function getEmail(): string
    {
        return $this->email;
    }

    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function setMobile(string $mobile): void
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
