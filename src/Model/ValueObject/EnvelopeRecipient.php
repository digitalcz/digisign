<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

use DateTimeImmutable;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeRecipient\EnvelopeRecipientEnvelope;

class EnvelopeRecipient
{
    /**
     * @var string
     */
    private $id;
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
     * @var string
     */
    private $status;
    /**
     * @var string
     */
    private $role;
    /**
     * @var EnvelopeRecipientEnvelope
     */
    private $envelope;
    /**
     * @var DateTimeImmutable|null
     */
    private $sentAt;
    /**
     * @var DateTimeImmutable|null
     */
    private $deliveredAt;
    /**
     * @var DateTimeImmutable|null
     */
    private $signedAt;
    /**
     * @var DateTimeImmutable|null
     */
    private $declinedAt;
    /**
     * @var string|null
     */
    private $emailBody;
    /**
     * @var string|null
     */
    private $metadata;

    public function __construct(
        string $id,
        string $name,
        string $email,
        string $mobile,
        string $status,
        string $role,
        EnvelopeRecipientEnvelope $envelope,
        ?DateTimeImmutable $sentAt = null,
        ?DateTimeImmutable $deliveredAt = null,
        ?DateTimeImmutable $signedAt = null,
        ?DateTimeImmutable $declinedAt = null,
        ?string $emailBody = null,
        ?string $metadata = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->status = $status;
        $this->role = $role;
        $this->envelope = $envelope;
        $this->sentAt = $sentAt;
        $this->deliveredAt = $deliveredAt;
        $this->signedAt = $signedAt;
        $this->declinedAt = $declinedAt;
        $this->emailBody = $emailBody;
        $this->metadata = $metadata;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            $data['email'],
            $data['mobile'],
            $data['status'],
            $data['role'],
            EnvelopeRecipientEnvelope::fromArray($data['envelope']),
            $data['sentAt'] ? new DateTimeImmutable($data['sentAt']) : null,
            $data['deliveredAt'] ? new DateTimeImmutable($data['deliveredAt']) : null,
            $data['signedAt'] ? new DateTimeImmutable($data['signedAt']) : null,
            $data['declinedAt'] ? new DateTimeImmutable($data['declinedAt']) : null,
            $data['emailBody'],
            $data['metadata']
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'mobile' => $this->mobile,
            'status' => $this->status,
            'role' => $this->role,
            'envelope' => $this->envelope->toArray(),
            'sentAt' => $this->sentAt ? $this->sentAt->format('c') : null,
            'deliveredAt' => $this->declinedAt ? $this->declinedAt->format('c') : null,
            'signedAt' => $this->signedAt ? $this->signedAt->format('c') : null,
            'declinedAt' => $this->declinedAt ? $this->declinedAt->format('c') : null,
            'emailBody' => $this->emailBody,
            'metadata' => $this->metadata,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getEmail(): string
    {
        return $this->email;
    }

    public function getMobile(): string
    {
        return $this->mobile;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getEnvelope(): EnvelopeRecipientEnvelope
    {
        return $this->envelope;
    }

    public function getSentAt(): ?DateTimeImmutable
    {
        return $this->sentAt;
    }

    public function getDeliveredAt(): ?DateTimeImmutable
    {
        return $this->deliveredAt;
    }

    public function getSignedAt(): ?DateTimeImmutable
    {
        return $this->signedAt;
    }

    public function getDeclinedAt(): ?DateTimeImmutable
    {
        return $this->declinedAt;
    }

    public function getEmailBody(): ?string
    {
        return $this->emailBody;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }
}
