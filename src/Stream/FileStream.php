<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Stream;

use DigitalCz\DigiSign\Exception\RuntimeException;
use InvalidArgumentException;

final class FileStream
{
    /** @var resource */
    private $handle;

    /** @var int|null  */
    private $size;

    /** @var string|null  */
    private $filename;

    /**
     * @param resource $handle
     */
    public function __construct($handle, ?int $size = null, ?string $filename = null)
    {
        if (!is_resource($handle)) {
            throw new InvalidArgumentException('Invalid $handle, resource is expected');
        }

        $this->handle = $handle;
        $this->size = $size;
        $this->filename = $filename;
    }

    public static function open(string $path): self
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
     * @param string $path Path to directory or file
     */
    public function save(string $path): void
    {
        if (is_dir($path)) {
            $path .= DIRECTORY_SEPARATOR . $this->getFilename();
        }

        $handle = fopen($path, 'wb+');

        if ($handle === false) {
            throw new RuntimeException('Failed to open/create file ' . $path);
        }

        $bytes = stream_copy_to_stream($this->getHandle(), $handle);

        if ($bytes === false) {
            throw new RuntimeException('Failed to write into ' . $path);
        }
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
