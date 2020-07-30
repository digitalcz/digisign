<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject\Request;

class Document
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
     * @var string
     */
    private $envelope;
    /**
     * @var string|null
     */
    private $metadata;

    public function __construct(string $name, string $file, string $envelope, ?string $metadata = null)
    {
        $this->name = $name;
        $this->file = $file;
        $this->envelope = $envelope;
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
            $data['envelope'],
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
            'envelope' => $this->envelope,
            'metadata' => $this->metadata,
        ];
    }
}
