<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign;

use InvalidArgumentException;
use RuntimeException;

final class Stream
{
    /**
     * @var resource
     */
    private $handle;
    private ?int $size;
    private ?string $filename;

    /**
     * @param resource $handle
     */
    public function __construct($handle, ?int $size = null, ?string $filename = null)
    {
        if (!is_resource($handle)) {
            throw new InvalidArgumentException('$handle must be resource');
        }

        $this->handle = $handle;
        $this->size = $size;
        $this->filename = $filename;
    }

    public static function fromFile(string $path): self
    {
        $handle = @fopen($path, 'rb+');

        if ($handle === false) {
            throw new RuntimeException('Failed to open file ' . $path);
        }

        $size = @filesize($path);

        if ($size === false) {
            throw new RuntimeException('Failed to get size of ' . $path);
        }

        return new self($handle, $size, basename($path));
    }

    /**
     * @return resource
     */
    public function getHandle()
    {
        return $this->handle;
    }

    public function getSize(): ?int
    {
        return $this->size;
    }

    public function setFilename(?string $filename): void
    {
        $this->filename = $filename;
    }

    public function getFilename(): ?string
    {
        return $this->filename;
    }
}
