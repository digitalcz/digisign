<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Envelope;

use DigitalCz\DigiSign\Api\BaseApiTestCase;
use DigitalCz\DigiSign\Model\DTO\EnvelopeNotificationData;
use Psr\Http\Message\ResponseInterface;

class EnvelopeNotificationApiTest extends BaseApiTestCase
{
    public function testDeleteNotification(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse
            ->method('getStatusCode')
            ->willReturn(204);
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeNotificationApi($this->httpClient, $this->requestBuilder);

        $deleteCode = $api->deleteNotification('1', '1');

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals(204, $deleteCode);
    }

    public function testCreateNotification(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../../Dummy/Responses/envelope_notification.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeNotificationApi($this->httpClient, $this->requestBuilder);

        $object = $api->createNotification('0211f410-268a-4ac3-ac40-b41ee7647092', new EnvelopeNotificationData(
            'signature',
            3
        ));

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals('6c4ff451-ec4c-461b-8b64-afb843db2883', $object->getId());
    }

    public function testUpdateNotification(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../../Dummy/Responses/envelope_notification.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeNotificationApi($this->httpClient, $this->requestBuilder);

        $object = $api->updateNotification(
            '0211f410-268a-4ac3-ac40-b41ee7647092',
            '0211f410-268a-4ac3-ac40-b41ee7647092',
            new EnvelopeNotificationData(
                'signature',
                5
            )
        );

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals('6c4ff451-ec4c-461b-8b64-afb843db2883', $object->getId());
    }


    public function testGetNotification(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../../Dummy/Responses/envelope_notification.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeNotificationApi($this->httpClient, $this->requestBuilder);

        $object = $api->getNotification(
            '0211f410-268a-4ac3-ac40-b41ee7647092',
            '0211f410-268a-4ac3-ac40-b41ee7647092'
        );

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals('6c4ff451-ec4c-461b-8b64-afb843db2883', $object->getId());
    }

    public function testGetNotifications(): void
    {
        $httpClient = $this->httpClient;

        $httpResponse = $this->createMock(ResponseInterface::class);
        $httpResponse->method('getStatusCode')->willReturn(200);
        $httpResponse->method('getBody')
            ->willReturn(
                file_get_contents(__DIR__ . '/../../Dummy/Responses/envelope_notifications.json')
            );
        $httpClient->addResponse($httpResponse);

        $api = new EnvelopeNotificationApi($this->httpClient, $this->requestBuilder);

        $list = $api->getNotifications(
            '0211f410-268a-4ac3-ac40-b41ee7647092'
        );

        self::assertCount(1, $httpClient->getRequests());
        self::assertEquals(1, $list->getPage());
        self::assertEquals(1, $list->getCount());
        self::assertEquals(30, $list->getItemsPerPage());
        self::assertEquals(1, count($list->getItems()));
    }
}
