<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\DTO;

use DigitalCz\DigiSign\Model\Iri\FileIri;
use InvalidArgumentException;

class EnvelopeDocumentData
{
    /**
     * @var string
     */
    private $name;
    /**
     * @var FileIri
     */
    private $file;
    /**
     * @var string|null
     */
    private $metadata;

    /**
     * @var int|null
     */
    private $position;

    /**
     * @param string $name
     * @param string|FileIri $file
     * @param string|null $metadata
     * @param int|null $position
     */
    public function __construct(string $name, $file, ?string $metadata = null, ?int $position = 0)
    {
        if (is_string($file)) {
            $file = FileIri::parse($file);
        } elseif (!$file instanceof FileIri) {
            throw new InvalidArgumentException('Invalid argument file, string or FileIri expected.');
        }

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
            $data['name'],
            $data['file'],
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
            'name' => $this->name,
            'file' => $this->file->toString(),
            'metadata' => $this->metadata,
            'position' => $this->position,
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
        return $this->file->toString();
    }

    public function setFile(string $file): void
    {
        $this->file = FileIri::parse($file);
    }

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function setMetadata(?string $metadata): void
    {
        $this->metadata = $metadata;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }

    public function setPosition(?int $position): void
    {
        $this->position = $position;
    }
}
