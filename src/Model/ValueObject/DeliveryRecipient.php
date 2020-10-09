<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

use DateTimeImmutable;

class DeliveryRecipient
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
     * @var string|null
     */
    private $mobile;
    /**
     * @var string
     */
    private $status;
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
    private $nonDeliveredAt;
    /**
     * @var DateTimeImmutable|null
     */
    private $cancelledAt;
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
        ?string $mobile,
        string $status,
        ?DateTimeImmutable $sentAt = null,
        ?DateTimeImmutable $deliveredAt = null,
        ?DateTimeImmutable $nonDeliveredAt = null,
        ?DateTimeImmutable $cancelledAt = null,
        ?string $emailBody = null,
        ?string $metadata = null
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->mobile = $mobile;
        $this->status = $status;
        $this->sentAt = $sentAt;
        $this->deliveredAt = $deliveredAt;
        $this->nonDeliveredAt = $nonDeliveredAt;
        $this->cancelledAt = $cancelledAt;
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
            $data['sentAt'] ? new DateTimeImmutable($data['sentAt']) : null,
            $data['deliveredAt'] ? new DateTimeImmutable($data['deliveredAt']) : null,
            $data['nonDeliveredAt'] ? new DateTimeImmutable($data['nonDeliveredAt']) : null,
            $data['cancelledAt'] ? new DateTimeImmutable($data['cancelledAt']) : null,
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
            'sentAt' => $this->sentAt ? $this->sentAt->format('c') : null,
            'deliveredAt' => $this->deliveredAt ? $this->deliveredAt->format('c') : null,
            'signedAt' => $this->nonDeliveredAt ? $this->nonDeliveredAt->format('c') : null,
            'declinedAt' => $this->cancelledAt ? $this->cancelledAt->format('c') : null,
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

    public function getMobile(): ?string
    {
        return $this->mobile;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getSentAt(): ?DateTimeImmutable
    {
        return $this->sentAt;
    }

    public function getDeliveredAt(): ?DateTimeImmutable
    {
        return $this->deliveredAt;
    }

    public function getNonDeliveredAt(): ?DateTimeImmutable
    {
        return $this->nonDeliveredAt;
    }

    public function getCancelledAt(): ?DateTimeImmutable
    {
        return $this->cancelledAt;
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
