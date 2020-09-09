<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject;

use DigitalCz\DigiSign\Model\ValueObject\EnvelopeDocument\EnvelopeDocumentFile;

class EnvelopeDocument
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
     * @var EnvelopeDocumentFile
     */
    private $file;

    public function __construct(
        string $id,
        string $name,
        EnvelopeDocumentFile $file,
        ?string $metadata = null
    ) {
        $this->id = $id;
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
            $data['id'],
            $data['name'],
            EnvelopeDocumentFile::fromArray($data['file']),
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
            'file' => $this->file->toArray(),
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

    public function getMetadata(): ?string
    {
        return $this->metadata;
    }

    public function getFile(): EnvelopeDocumentFile
    {
        return $this->file;
    }
}
