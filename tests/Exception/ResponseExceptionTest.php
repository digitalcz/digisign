<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Exception;

use Nyholm\Psr7\Response;
use PHPStan\Testing\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Exception\ResponseException
 */
class ResponseExceptionTest extends TestCase
{
    public function testMessageWithoutResult(): void
    {
        $response = new Response(404);
        $exception = new ResponseException($response);
        self::assertSame('404 Not Found: Empty response body', $exception->getMessage());
    }

    public function testMessageWithoutErrorResponse(): void
    {
        $response = new Response(400, [], '{"title": "Error","detail":"foo"}');
        $exception = new ResponseException($response);
        self::assertSame('400 Bad Request: Error: foo', $exception->getMessage());
    }

    public function testMessageProvided(): void
    {
        $response = new Response(404, [], '{}');
        $exception = new ResponseException($response, 'Foo bar');
        self::assertSame('Foo bar', $exception->getMessage());
    }
}
