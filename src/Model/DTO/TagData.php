<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

class TagData
{
    /**
     * @var string
     */
    private $type;

    /**
     * @var string
     */
    private $recipient;

    /**
     * @var string
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

    public function __construct(
        string $type,
        string $recipient,
        string $document,
        ?int $page,
        ?int $xPosition,
        ?int $yPosition
    ) {
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
            'recipient' => $this->recipient,
            'document' => $this->document,
        ];
    }

    public function getType(): string
    {
        return $this->type;
    }

    public function getRecipient(): string
    {
        return $this->recipient;
    }

    public function getDocument(): string
    {
        return $this->document;
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
