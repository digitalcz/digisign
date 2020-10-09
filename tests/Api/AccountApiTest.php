<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api;

use Psr\Http\Message\ResponseInterface;

class AccountApiTest extends BaseApiTestCase
{

    public function testGetAccount(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../Dummy/Responses/account.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new AccountApi($this->httpClient, $this->requestBuilder);

        $account = $api->getAccount();

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals("5514d509-0874-45c7-b6e8-5654487", $account->getId());
        self::assertEquals('hans@digital.cz', $account->getEmail());
        self::assertEquals('active', $account->getStatus());
    }
}
