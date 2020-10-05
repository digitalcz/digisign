<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

class DeliveryDocument
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
     * @var string|null
     */
    private $metadata;
    /**
     * @var File
     */
    private $file;
    /**
     * @var int|null
     */
    private $position;

    public function __construct(
        string $id,
        string $name,
        File $file,
        ?string $metadata = null,
        ?int $position = 0
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->file = $file;
        $this->metadata = $metadata;
        $this->position = $position;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['id'],
            $data['name'],
            File::fromArray($data['file']),
            $data['metadata'],
            $data['position']
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
            'file' => $this->file->toArray(),
            'metadata' => $this->metadata,
            'position' => $this->position,
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

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function getFile(): File
    {
        return $this->file;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }
}
