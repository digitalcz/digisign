<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Stream;

use DigitalCz\DigiSign\Exception\RuntimeException;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Stream\FileResponse
 */
class FileResponseTest extends TestCase
{
    public function testGetFile(): void
    {
        $sourceFile = fopen(TESTS_DIR . '/dummy.pdf', 'rb+');
        self::assertIsResource($sourceFile);
        $headers = [
            'Content-Disposition' => "attachment; filename=bar.pdf; filename*=utf-8''foo.pdf",
            'Content-Length' => 13264,
        ];
        $httpResponse = new Response(200, $headers, $sourceFile);
        $response = new FileResponse($httpResponse);
        $file = $response->getFile();
        self::assertSame('foo.pdf', $file->getFilename());
        self::assertSame(13264, $file->getSize());
    }

    public function testSave(): void
    {
        $sourceFile = fopen(TESTS_DIR . '/dummy.pdf', 'rb+');
        self::assertIsResource($sourceFile);
        $headers = [
            'Content-Disposition' => "attachment; filename=bar.pdf; filename*=utf-8''foo.pdf",
            'Content-Length' => 13264,
        ];
        $httpResponse = new Response(200, $headers, $sourceFile);
        $response = new FileResponse($httpResponse);
        $savePath = tempnam(sys_get_temp_dir(), '');
        self::assertIsString($savePath);
        $response->save($savePath);
        self::assertFileEquals(TESTS_DIR . '/dummy.pdf', $savePath);
        unlink($savePath);
    }

    public function testUnableToGetBody(): void
    {
        $sourceFile = fopen(TESTS_DIR . '/dummy.pdf', 'rb+');
        self::assertIsResource($sourceFile);
        $headers = [
            'Content-Disposition' => "attachment; filename=bar.pdf; filename*=utf-8''foo.pdf",
            'Content-Length' => 13264,
        ];
        $httpResponse = new Response(200, $headers, $sourceFile);
        $httpResponse->getBody()->detach(); // detach body

        $response = new FileResponse($httpResponse);

        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Unable to get body handle');
        $response->getFile();
    }
}
