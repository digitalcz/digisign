<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use DigitalCz\DigiSign\Model\Iri\EnvelopeDocumentIri;
use DigitalCz\DigiSign\Model\Iri\EnvelopeRecipientIri;
use InvalidArgumentException;

class EnvelopeTagData
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var EnvelopeRecipientIri
     */
    private $recipient;

    /**
     * @var EnvelopeDocumentIri
     */
    private $document;

    /**
     * @var int|null
     */
    private $page;

    /**
     * @var int|null
     */
    private $xPosition;

    /**
     * @var int|null
     */
    private $yPosition;

    /**
     * @param string|EnvelopeRecipientIri $recipient
     * @param string|EnvelopeDocumentIri $document
     */
    public function __construct(
        string $type,
        $recipient,
        $document,
        ?int $page,
        ?int $xPosition,
        ?int $yPosition
    ) {
        if (is_string($recipient)) {
            $recipient = EnvelopeRecipientIri::parse($recipient);
        } elseif (!$recipient instanceof EnvelopeRecipientIri) {
            throw new InvalidArgumentException('Invalid argument recipient, string or EnvelopeRecipientIri expected.');
        }

        if (is_string($document)) {
            $document = EnvelopeDocumentIri::parse($document);
        } elseif (!$document instanceof EnvelopeDocumentIri) {
            throw new InvalidArgumentException('Invalid argument recipient, string or EnvelopeDocumentIri expected.');
        }

        $this->type = $type;
        $this->recipient = $recipient;
        $this->document = $document;
        $this->page = $page;
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['type'],
            $data['recipient'],
            $data['document'],
            $data['page'] ? (int)$data['page'] : null,
            $data['xPosition'] ? (int)$data['xPosition'] : null,
            $data['yPosition'] ? (int)$data['yPosition'] : null
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'type' => $this->type,
            'page' => $this->page,
            'xPosition' => $this->xPosition,
            'yPosition' => $this->yPosition,
            'recipient' => $this->recipient->toString(),
            'document' => $this->document->toString(),
        ];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getRecipient(): string
    {
        return $this->recipient->toString();
    }

    public function getDocument(): string
    {
        return $this->document->toString();
    }

    public function getPage(): ?int
    {
        return $this->page;
    }

    public function getXPosition(): ?int
    {
        return $this->xPosition;
    }

    public function getYPosition(): ?int
    {
        return $this->yPosition;
    }
}
