<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use DateTimeImmutable;

class DeliveryData
{
    /**
     * @var string
     */
    private $emailSubject;
    /**
     * @var string
     */
    private $emailBody;
    /**
     * @var string|null
     */
    private $senderName;
    /**
     * @var string|null
     */
    private $senderEmail;
    /**
     * @var DateTimeImmutable|null
     */
    private $validTo;
    /**
     * @var string|null
     */
    private $metadata;

    public function __construct(
        string $emailSubject,
        string $emailBody,
        ?string $senderName = null,
        ?string $senderEmail = null,
        ?DateTimeImmutable $validTo = null,
        ?string $metadata = null
    ) {
        $this->emailSubject = $emailSubject;
        $this->emailBody = $emailBody;
        $this->senderName = $senderName;
        $this->senderEmail = $senderEmail;
        $this->validTo = $validTo;
        $this->metadata = $metadata;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['emailSubject'],
            $data['emailBody'],
            $data['senderName'],
            $data['senderEmail'],
            $data['validTo'],
            $data['metadata']
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'emailSubject' => $this->emailSubject,
            'emailBody' => $this->emailBody,
            'senderName' => $this->senderName,
            'senderEmail' => $this->senderEmail,
            'validTo' => $this->validTo ? $this->validTo->format('c') : null,
            'metadata' => $this->metadata,
        ];
    }

    public function getEmailSubject(): string
    {
        return $this->emailSubject;
    }

    public function setEmailSubject(string $emailSubject): void
    {
        $this->emailSubject = $emailSubject;
    }

    public function getEmailBody(): string
    {
        return $this->emailBody;
    }

    public function setEmailBody(string $emailBody): void
    {
        $this->emailBody = $emailBody;
    }

    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    public function setSenderName(?string $senderName): void
    {
        $this->senderName = $senderName;
    }

    public function getSenderEmail(): ?string
    {
        return $this->senderEmail;
    }

    public function setSenderEmail(?string $senderEmail): void
    {
        $this->senderEmail = $senderEmail;
    }

    public function getValidTo(): ?DateTimeImmutable
    {
        return $this->validTo;
    }

    public function setValidTo(?DateTimeImmutable $validTo): void
    {
        $this->validTo = $validTo;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(?string $metadata): void
    {
        $this->metadata = $metadata;
    }
}
