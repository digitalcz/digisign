<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use DigitalCz\DigiSign\Model\Stream;
use Psr\Http\Message\ResponseInterface;

class FileApiTest extends BaseApiTestCase
{

    public function testCreateFile(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../Dummy/Responses/file.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new FileApi($this->httpClient, $this->requestBuilder);


        $stream = Stream::fromTemp();
        $file = $api->createFile($stream);

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals("b8097043-a50d-4e01-8e6f-beaeac5eb0b2", $file->getId());
        self::assertEquals("dummy-5f8415db00ab8434275265.pdf", $file->getName());
        self::assertEquals("dummy.pdf", $file->getOriginalName());
        self::assertEquals("6490304685c1cab33072adc5a4a6ad471029150d", $file->getSha1Checksum());
        self::assertEquals(10035, $file->getSize());
        self::assertEquals("application/pdf", $file->getMimeType());
    }
}
