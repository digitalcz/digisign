<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Response\Notification;

use DigitalCz\DigiSign\Http\Response\BaseHttpResponse;
use DigitalCz\DigiSign\Model\ValueObject\EnvelopeNotification;
use Psr\Http\Message\ResponseInterface;

class NotificationResponse extends BaseHttpResponse
{

    public function __invoke(ResponseInterface $response): EnvelopeNotification
    {
        $this->handleResponseCode($response);

        return EnvelopeNotification::fromArray($this->parseResponseBody($response));
    }
}
