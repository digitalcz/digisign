<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model;

use DigitalCz\DigiSign\Exception\RuntimeException;

class Stream
{
    /**
     * @var resource
     */
    private $handle;

    /**
     * @param resource $handle
     */
    private function __construct($handle)
    {
        if (!is_resource($handle)) {
            throw new RuntimeException('Handle is not resource');
        }

        $this->handle = $handle;
    }

    public static function fromTemp(): self
    {
        $tmpFile = tmpfile();

        if ($tmpFile === false) {
            throw new RuntimeException('Tmp file not created');
        }

        return self::fromHandle($tmpFile);
    }

    public static function fromPath(string $path): self
    {
        $handle = fopen($path, 'rb+');

        if ($handle === false) {
            throw new RuntimeException('Problem with open file');
        }

        return self::fromHandle($handle);
    }

    /**
     * @param resource $handle
     */
    public static function fromHandle($handle): self
    {
        return new self($handle);
    }

    /**
     * @return resource
     */
    public function getHandle()
    {
        return $this->handle;
    }
}
