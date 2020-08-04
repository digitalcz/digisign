<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject\Request;

use DateTimeImmutable;

class Envelope
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
     * @var string
     */
    private $metadata;

    public function __construct(
        string $emailSubject,
        string $emailBody,
        ?string $senderName,
        ?string $senderEmail,
        ?DateTimeImmutable $validTo,
        string $metadata
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

    public function getEmailBody(): string
    {
        return $this->emailBody;
    }

    public function getSenderName(): ?string
    {
        return $this->senderName;
    }

    public function getSenderEmail(): ?string
    {
        return $this->senderEmail;
    }

    public function getValidTo(): ?DateTimeImmutable
    {
        return $this->validTo;
    }

    public function getMetadata(): string
    {
        return $this->metadata;
    }
}
