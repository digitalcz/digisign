<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\ValueObject\Envelope;

use DigitalCz\DigiSign\Model\Stream;

class EnvelopeFile
{

    public const OUTPUT_SEPARATE = 'separate';
    public const OUTPUT_COMBINED = 'combined';
    public const OUTPUT_ONLY_LOG = 'only_log';

    /**
     * @var string
     */
    private $contentDisposition;
    /**
     * @var string
     */
    private $contentType;
    /**
     * @var int
     */
    private $contentLength;
    /**
     * @var Stream
     */
    private $stream;

    public function __construct(string $contentDisposition, string $contentType, int $contentLength, Stream $stream)
    {
        $this->contentDisposition = $contentDisposition;
        $this->contentType = $contentType;
        $this->contentLength = $contentLength;
        $this->stream = $stream;
    }

    public function getContentDisposition(): string
    {
        return $this->contentDisposition;
    }

    public function getContentType(): string
    {
        return $this->contentType;
    }

    public function getContentLength(): int
    {
        return $this->contentLength;
    }

    public function getStream(): Stream
    {
        return $this->stream;
    }

    public function getFilenameFromContentDisposition(): string
    {
        [, $filename] = explode("filename=", $this->contentDisposition);

        return (string)$filename;
    }
}
