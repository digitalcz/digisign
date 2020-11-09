<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Notification;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeNotification\EnvelopeNotificationList;
use Psr\Http\Message\ResponseInterface;

class NotificationsGetResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeNotificationList
    {
        $this->handleResponseCode($response);

        return EnvelopeNotificationList::fromArray($this->parseResponseBody($response));
    }
}
