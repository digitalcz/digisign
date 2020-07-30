<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\ValueObject;

class File
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
     * @var string
     */
    private $originalName;
    /**
     * @var string
     */
    private $mimeType;
    /**
     * @var int
     */
    private $size;
    /**
     * @var string
     */
    private $sha1Checksum;

    public function __construct(
        string $id,
        string $name,
        string $originalName,
        string $mimeType,
        int $size,
        string $sha1Checksum
    ) {
        $this->id = $id;
        $this->name = $name;
        $this->originalName = $originalName;
        $this->mimeType = $mimeType;
        $this->size = $size;
        $this->sha1Checksum = $sha1Checksum;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getOriginalName(): string
    {
        return $this->originalName;
    }

    public function getMimeType(): string
    {
        return $this->mimeType;
    }

    public function getSize(): int
    {
        return $this->size;
    }

    public function getSha1Checksum(): string
    {
        return $this->sha1Checksum;
    }

    /**
     * @param array<mixed> $data
     * @return File
     */
    public static function fromArray(array $data): File
    {
        return new File(
            $data['id'],
            $data['name'],
            $data['originalName'],
            $data['mimeType'],
            $data['size'],
            $data['sha1Checksum']
        );
    }

    /**
     * @return array<mixed>
     */
    public function toArray(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'originalName' => $this->originalName,
            'mimeType' => $this->mimeType,
            'size' => $this->size,
            'sha1Checksum' => $this->sha1Checksum,
        ];
    }
}
