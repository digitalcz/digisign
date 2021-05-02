<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Stream\FileStream;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\FilesEndpoint
 */
class FilesEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/files?foo=bar');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/files/foo');
    }

    public function testUpload(): void
    {
        $file = FileStream::open(TESTS_DIR . '/dummy.pdf');
        self::endpoint()->upload($file);
        self::assertLastRequest('POST', '/api/files');
        $lastRequest = self::getLastRequest();
        $contentType = $lastRequest->getHeaderLine('Content-Type');
        $boundary = trim(substr($contentType, 30), '"');
        self::assertSame("multipart/form-data; boundary=\"$boundary\"", $contentType);
        self::assertSame(
            "--$boundary\r\n" .
            "Content-Disposition: form-data; name=\"file\"; filename=\"dummy.pdf\"\r\n" .
            "Content-Length: " . $file->getSize() . "\r\n" .
            "Content-Type: application/pdf\r\n" .
            "\r\n" .
            file_get_contents(TESTS_DIR . '/dummy.pdf') . "\r\n" .
            "--$boundary--\r\n",
            (string)$lastRequest->getBody(),
        );
    }

    public function testContent(): void
    {
        self::endpoint()->content('foo');
        self::assertLastRequest('GET', '/api/files/foo/content');
    }

    protected static function endpoint(): FilesEndpoint
    {
        return self::digiSign()->files();
    }
}
