<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject\Response;

use DateTimeImmutable;

class Tag
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
     * @var DateTimeImmutable
     */
    private $createdAt;

    /**
     * @var DateTimeImmutable
     */
    private $updatedAt;

    public function __construct(
        string $id,
        string $type,
        ?int $page,
        ?int $xPosition,
        ?int $yPosition,
        DateTimeImmutable $createdAt,
        DateTimeImmutable $updatedAt
    ) {
        $this->id = $id;
        $this->type = $type;
        $this->page = $page;
        $this->xPosition = $xPosition;
        $this->yPosition = $yPosition;
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
            $data['page'] ? (int)$data['page'] : null,
            $data['xPosition'] ? (int)$data['xPosition'] : null,
            $data['yPosition'] ? (int)$data['yPosition'] : null,
            $data['createdAt'] ? new DateTimeImmutable($data['createdAt']) : null,
            $data['updatedAt'] ? new DateTimeImmutable($data['updatedAt']) : null
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
            'page' => $this->page,
            'xPosition' => $this->xPosition,
            'yPosition' => $this->yPosition,
            'createdAt' => $this->createdAt ? $this->createdAt->format('c') : null,
            'updatedAt' => $this->updatedAt ? $this->updatedAt->format('c') : null,
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

    public function getCreatedAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTimeImmutable
    {
        return $this->updatedAt;
    }
}
