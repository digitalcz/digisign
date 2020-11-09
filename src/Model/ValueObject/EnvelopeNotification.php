<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

use DateTimeImmutable;

class EnvelopeNotification
{
    /**
     * @var string
     */
    private $id;

    /**
     * @var string
     */
    private $type;

    /**
     * @var int
     */
    private $days;

    /**
     * @var string
     */
    private $status;

    /**
     * @var DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var DateTimeImmutable
     */
    private $updatedAt;

    /**
     * @var DateTimeImmutable|null
     */
    private $sentAt;

    /**
     * @var DateTimeImmutable|null
     */
    private $cancelledAt;

    public function __construct(
        string $id,
        string $type,
        int $days,
        string $status,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt,
        ?DateTimeImmutable $sentAt,
        ?DateTimeImmutable $cancelledAt
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->days = $days;
        $this->status = $status;
        $this->sentAt = $sentAt;
        $this->cancelledAt = $cancelledAt;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['type'],
            $data['days'],
            $data['status'],
            new DateTimeImmutable($data['createdAt']),
            new DateTimeImmutable($data['updatedAt']),
            $data['sentAt'] ? new DateTimeImmutable($data['sentAt']) : null,
            $data['cancelledAt'] ? new DateTimeImmutable($data['cancelledAt']) : null
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'type' => $this->type,
            'days' => $this->days,
            'status' => $this->status,
            'createdAt' => $this->createdAt->format('c'),
            'updatedAt' => $this->updatedAt->format('c'),
            'sentAt' => $this->sentAt ? $this->sentAt->format('c') : null,
            'cancelledAt' => $this->cancelledAt ? $this->cancelledAt->format('c') : null,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getDays(): int
    {
        return $this->days;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function getSentAt(): ?DateTimeImmutable
    {
        return $this->sentAt;
    }

    public function getCancelledAt(): ?DateTimeImmutable
    {
        return $this->cancelledAt;
    }
}
