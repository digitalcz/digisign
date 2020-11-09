<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Envelope;

use DigitalCz\DigiSign\Api\BaseApiTestCase;
use Psr\Http\Message\ResponseInterface;

class EnvelopeApiTest extends BaseApiTestCase
{
    public function testCancelEnvelope(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse
            ->method('getStatusCode')
            ->willReturn(200);
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeApi($this->httpClient, $this->requestBuilder);

        $responseCode = $api->cancelEnvelope('1');

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals(200, $responseCode);
    }

    public function testSendEnvelope(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse
            ->method('getStatusCode')
            ->willReturn(200);
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeApi($this->httpClient, $this->requestBuilder);

        $responseCode = $api->sendEnvelope('1');

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals(200, $responseCode);
    }
}
