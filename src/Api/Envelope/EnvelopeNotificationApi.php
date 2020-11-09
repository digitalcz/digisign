<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Api\Envelope;

use DigitalCz\DigiSign\Api\BaseApi;
use DigitalCz\DigiSign\Http\Request\EnvelopeNotification\NotificationDeleteRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeNotification\NotificationGetRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeNotification\NotificationPostRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeNotification\NotificationPutRequest;
use DigitalCz\DigiSign\Http\Request\EnvelopeNotification\NotificationsGetRequest;
use DigitalCz\DigiSign\Http\Response\Notification\NotificationDeleteResponse;
use DigitalCz\DigiSign\Http\Response\Notification\NotificationResponse;
use DigitalCz\DigiSign\Http\Response\Notification\NotificationsGetResponse;
use DigitalCz\DigiSign\Model\DTO\EnvelopeNotificationData;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeNotification;

class EnvelopeNotificationApi extends BaseApi
{

    public function createNotification(string $envelopeId, EnvelopeNotificationData $object): EnvelopeNotification
    {
        $httpRequest = (new NotificationPostRequest($this->requestBuilder))($envelopeId, $object);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new NotificationResponse())($httpResponse);
    }

    public function updateNotification(
        string $envelopeId,
        string $notificationId,
        EnvelopeNotificationData $object
    ): EnvelopeNotification {
        $httpRequest = (new NotificationPutRequest($this->requestBuilder))($envelopeId, $notificationId, $object);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new NotificationResponse())($httpResponse);
    }


    public function getNotification(string $envelopeId, string $notificationId): EnvelopeNotification
    {
        $httpRequest = (new NotificationGetRequest($this->requestBuilder))($envelopeId, $notificationId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new NotificationResponse())($httpResponse);
    }

    public function getNotifications(
        string $envelopeId,
        int $page = 1,
        int $itemsPerPage = 30
    ): EnvelopeNotification\EnvelopeNotificationList {
        $httpRequest = (new NotificationsGetRequest($this->requestBuilder))($envelopeId, $page, $itemsPerPage);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new NotificationsGetResponse())($httpResponse);
    }

    public function deleteNotification(string $envelopeId, string $notificationId): int
    {
        $httpRequest = (new NotificationDeleteRequest($this->requestBuilder))($envelopeId, $notificationId);
        $httpResponse = $this->client->sendRequest($httpRequest);

        return (new NotificationDeleteResponse())($httpResponse);
    }
}
