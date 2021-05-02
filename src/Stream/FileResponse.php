<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Stream;

use DigitalCz\DigiSign\Exception\RuntimeException;
use Psr\Http\Message\ResponseInterface;

/**
 * Wrapper class for file response
 */
final class FileResponse
{
    private ResponseInterface $response;
    private FileStream $file;

    public function __construct(ResponseInterface $response)
    {
        $this->response = $response;
    }

    public function getResponse(): ResponseInterface
    {
        return $this->response;
    }

    public function getFile(): FileStream
    {
        if (!isset($this->file)) {
            $body = $this->getResponse()->getBody();
            $handle = $body->detach();

            if ($handle === null) {
                throw new RuntimeException('Unable to get body handle');
            }

            $this->file = new FileStream($handle, $this->getContentLength(), $this->parseFilename());
        }

        return $this->file;
    }

    public function save(string $path): void
    {
        $this->getFile()->save($path);
    }

    private function parseFilename(): string
    {
        $contentDisposition = $this->getContentDisposition();

        // parse content-disposition header
        preg_match_all(
            "/filename[^;=\n]*=(?:(\\?['\"])(.*?)\1|(?:[^\s]+'.*?')?([^;\n]*))/i",
            $contentDisposition,
            $matches,
        );

        // if there are multiple matches, return the last
        return $matches[3][array_key_last($matches[3])] ?? 'file';
    }

    private function getContentLength(): int
    {
        return (int)$this->getResponse()->getHeaderLine('Content-Length');
    }

    private function getContentDisposition(): string
    {
        return $this->getResponse()->getHeaderLine('Content-Disposition');
    }
}
