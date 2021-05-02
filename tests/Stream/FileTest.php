<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Stream;

use DigitalCz\DigiSign\Exception\RuntimeException;
use PHPUnit\Framework\TestCase;

use const TESTS_DIR;

/**
 * @covers \DigitalCz\DigiSign\Stream\FileStream
 */
class FileTest extends TestCase
{
    public function testFromFile(): void
    {
        $file = FileStream::open(TESTS_DIR . '/dummy.pdf');
        self::assertSame('dummy.pdf', $file->getFilename());
        self::assertSame(13264, $file->getSize());
        self::assertIsResource($file->getHandle());
        $file->setFilename('foo.pdf');
        self::assertSame('foo.pdf', $file->getFilename());
    }

    public function testFailToOpen(): void
    {
        $this->expectException(RuntimeException::class);
        $this->expectExceptionMessage('Failed to open file foo');
        FileStream::open('foo');
    }

    public function testSave(): void
    {
        $file = FileStream::open(TESTS_DIR . '/dummy.pdf');
        $savePath = tempnam(sys_get_temp_dir(), '');
        self::assertIsString($savePath);
        $file->save($savePath);
        self::assertFileEquals(TESTS_DIR . '/dummy.pdf', $savePath);
        unlink($savePath);
    }
}
