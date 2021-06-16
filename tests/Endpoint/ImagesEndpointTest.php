<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Stream\FileStream;

/**
 * @covers \DigitalCz\DigiSign\Endpoint\ImagesEndpoint
 */
class ImagesEndpointTest extends EndpointTestCase
{
    public function testList(): void
    {
        self::endpoint()->list(['foo' => 'bar']);
        self::assertLastRequest('GET', '/api/images?foo=bar');
    }

    public function testGet(): void
    {
        self::endpoint()->get('foo');
        self::assertLastRequest('GET', '/api/images/foo');
    }

    public function testUpload(): void
    {
        $image = FileStream::open(TESTS_DIR . '/dummy.png');
        self::endpoint()->upload($image, true);
        self::assertLastRequest('POST', '/api/images');
        $lastRequest = self::getLastRequest();
        $contentType = $lastRequest->getHeaderLine('Content-Type');
        $boundary = trim(substr($contentType, 30), '"');
        self::assertSame("multipart/form-data; boundary=\"$boundary\"", $contentType);
        self::assertSame(
            "--$boundary\r\n" .
            "Content-Disposition: form-data; name=\"image\"; filename=\"dummy.png\"\r\n" .
            "Content-Length: " . $image->getSize() . "\r\n" .
            "Content-Type: image/png\r\n" .
            "\r\n" .
            file_get_contents(TESTS_DIR . '/dummy.png') . "\r\n" .
            "--$boundary\r\n" .
            "Content-Disposition: form-data; name=\"public\"\r\n" .
            "Content-Length: 4\r\n" .
            "\r\n" .
            "true\r\n" .
            "--$boundary--\r\n",
            (string)$lastRequest->getBody()
        );
    }

    public function testContent(): void
    {
        self::endpoint()->content('foo');
        self::assertLastRequest('GET', '/api/images/foo/content');
    }

    protected static function endpoint(): ImagesEndpoint
    {
        return self::dgs()->images();
    }
}
