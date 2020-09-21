<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

class DeliveryDocumentData
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var string
     */
    private $file;
    /**
     * @var string|null
     */
    private $metadata;

    public function __construct(string $name, string $file, ?string $metadata = null)
    {
        $this->name = $name;
        $this->file = $file;
        $this->metadata = $metadata;
    }

    /**
     * @param array<mixed> $data
     */
    public static function fromArray(array $data): self
    {
        return new self(
            $data['name'],
            $data['file'],
            $data['metadata']
        );
    }

    /**
     * @return mixed[]
     */
    public function toArray(): array
    {
        return [
            'name' => $this->name,
            'file' => $this->file,
            'metadata' => $this->metadata,
        ];
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getFile(): string
    {
        return $this->file;
    }

    public function setFile(string $file): void
    {
        $this->file = $file;
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
