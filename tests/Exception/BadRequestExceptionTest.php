<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Exception;

use DigitalCz\DigiSign\DigiSignClient;
use DigitalCz\DigiSign\Resource\Violation;
use Nyholm\Psr7\Response;
use PHPUnit\Framework\TestCase;

/**
 * @covers \DigitalCz\DigiSign\Exception\BadRequestException
 * @covers \DigitalCz\DigiSign\Resource\Violations
 */
class BadRequestExceptionTest extends TestCase
{
    public function testGetViolations(): void // phpcs:ignore
    {
        $result = [
            'title' => 'Validation Failed',
            'detail' => 'email: Tato hodnota nesmí být prázdná.',
            'violations' => [
                [
                    'propertyPath' => 'email',
                    'title' => 'Tato hodnota nesmí být prázdná.',
                    'parameters' => [
                        '{{ value }}' => 'null',
                    ],
                    'type' => 'urn:uuid:c1051bb4-d103-4f74-8988-acbcafc7fdc3',
                ],
            ],
        ];

        $response = new Response(400, [], DigiSignClient::jsonEncode($result));
        $exception = new BadRequestException($response);
        $violations = $exception->getViolations();

        self::assertNotNull($violations);
        self::assertSame('Validation Failed', $violations->title);
        self::assertSame('email: Tato hodnota nesmí být prázdná.', $violations->detail);
        self::assertCount(1, $violations->violations);

        $violation = $violations->violations[0];
        self::assertInstanceOf(Violation::class, $violation);
        self::assertSame('email', $violation->propertyPath);
        self::assertSame('Tato hodnota nesmí být prázdná.', $violation->title);
        self::assertSame(['{{ value }}' => 'null'], $violation->parameters);
        self::assertSame('urn:uuid:c1051bb4-d103-4f74-8988-acbcafc7fdc3', $violation->type);
    }

    public function testEmptyResponse(): void
    {
        $response = new Response(204);
        $exception = new BadRequestException($response);
        self::assertNull($exception->getViolations());
    }
}
