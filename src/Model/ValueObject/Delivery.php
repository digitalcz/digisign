<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

use DateTimeImmutable;

class Delivery
{
    /**
     * @var string
     */
    private $id;
    /**
     * @var string
     */
    private $emailSubject;
    /**
     * @var string
     */
    private $emailBody;
    /**
     * @var string
     */
    private $status;
    /**
     * @var array<DeliveryRecipient>|DeliveryRecipient[]
     */
    private $recipients = [];
    /**
     * @var array<DeliveryDocument>|DeliveryDocument[]
     */
    private $documents = [];
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
     * @var DateTimeImmutable|null
     */
    private $sentAt;
    /**
     * @var DateTimeImmutable|null
     */
    private $cancelledAt;
    /**
     * @var DateTimeImmutable|null
     */
    private $declinedAt;
    /**
     * @var string|null
     */
    private $metadata;

    /**
     * @param array<DeliveryRecipient>|DeliveryRecipient[] $recipients
     * @param array<DeliveryDocument>|DeliveryDocument[] $documents
     */
    public function __construct(
        string $id,
        string $emailSubject,
        string $emailBody,
        string $status,
        $recipients,
        $documents,
        ?string $senderName,
        ?string $senderEmail,
        ?DateTimeImmutable $validTo,
        ?DateTimeImmutable $sentAt,
        ?DateTimeImmutable $cancelledAt,
        ?DateTimeImmutable $declinedAt,
        ?string $metadata
    ) {
        $this->id = $id;
        $this->emailSubject = $emailSubject;
        $this->emailBody = $emailBody;
        $this->status = $status;
        $this->recipients = $recipients;
        $this->documents = $documents;
        $this->senderName = $senderName;
        $this->senderEmail = $senderEmail;
        $this->validTo = $validTo;
        $this->sentAt = $sentAt;
        $this->cancelledAt = $cancelledAt;
        $this->declinedAt = $declinedAt;
        $this->metadata = $metadata;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        $recipients = [];
        $documents = [];

        foreach ($data['recipients'] as $recipient) {
            $recipients[] = DeliveryRecipient::fromArray($recipient);
        }

        foreach ($data['documents'] as $document) {
            $documents[] = DeliveryDocument::fromArray($document);
        }

        return new self(
            $data['id'],
            $data['emailSubject'],
            $data['emailBody'],
            $data['status'],
            $recipients,
            $documents,
            $data['senderName'],
            $data['senderEmail'],
            $data['validTo'] ? new DateTimeImmutable($data['validTo']) : null,
            $data['sentAt'] ? new DateTimeImmutable($data['sentAt']) : null,
            $data['cancelledAt'] ? new DateTimeImmutable($data['cancelledAt']) : null,
            $data['declinedAt'] ? new DateTimeImmutable($data['declinedAt']) : null,
            $data['metadata']
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        $recipients = [];
        $documents = [];

        foreach ($this->recipients as $recipient) {
            $recipients[] = $recipient->toArray();
        }

        foreach ($this->documents as $document) {
            $documents[] = $document->toArray();
        }

        return [
            'id' => $this->id,
            'emailSubject' => $this->emailSubject,
            'emailBody' => $this->emailBody,
            'status' => $this->status,
            'recipients' => $recipients,
            'documents' => $documents,
            'senderName' => $this->senderName,
            'senderEmail' => $this->senderEmail,
            'validTo' => $this->validTo ? $this->validTo->format('c') : null,
            'sentAt' => $this->sentAt ? $this->sentAt->format('c') : null,
            'cancelledAt' => $this->cancelledAt ? $this->cancelledAt->format('c') : null,
            'declinedAt' => $this->declinedAt ? $this->declinedAt->format('c') : null,
            'metadata' => $this->metadata,
        ];
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getEmailSubject(): string
    {
        return $this->emailSubject;
    }

    public function getEmailBody(): string
    {
        return $this->emailBody;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    /**
     * @return array<DeliveryRecipient>|DeliveryRecipient[]
     */
    public function getRecipients()
    {
        return $this->recipients;
    }

    /**
     * @return array<DeliveryDocument>|DeliveryDocument[]
     */
    public function getDocuments()
    {
        return $this->documents;
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

    public function getSentAt(): ?DateTimeImmutable
    {
        return $this->sentAt;
    }

    public function getCancelledAt(): ?DateTimeImmutable
    {
        return $this->cancelledAt;
    }

    public function getDeclinedAt(): ?DateTimeImmutable
    {
        return $this->declinedAt;
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }
}
