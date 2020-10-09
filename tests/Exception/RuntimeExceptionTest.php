<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Exception;

use Exception;
use PHPUnit\Framework\TestCase;

class RuntimeExceptionTest extends TestCase
{

    public function testRuntimeException(): void
    {
        $responseData = [
            'type' => 'https://symfony.com/errors/validation',
            'title' => 'Validation Failed',
            'detail' => 'senderEmail: Tato hodnota není platná e-mailová adresa',
            'status' => 400,
            'violations' => [
                "propertyPath" => "senderEmail",
                "title" => "Tato hodnota není platná e-mailová adresa.",
                "parameters" => [
                    '{{ value }}' => '"bad email"'
                ],
                "type" => "urn:uuid:bd79c0ab-ddba-46cc-a703-a7a4b08de310",
            ],
        ];
        $body = json_encode($responseData);

        $previousException = new Exception('Previous', 400);
        $exception = new RuntimeException($body !== false ? $body : '', 400, $previousException);

        $this->assertEquals(400, $exception->getCode());
        $this->assertEquals($previousException, $exception->getPrevious());
        $this->assertEquals($responseData['type'], $exception->getType());
        $this->assertEquals($responseData['title'], $exception->getTitle());
        $this->assertEquals($responseData['detail'], $exception->getDetail());
        $this->assertEquals($responseData['violations'], $exception->getViolations());
    }
}
