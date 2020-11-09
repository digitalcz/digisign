<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeNotification;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeNotificationData;
use Psr\Http\Message\RequestInterface;

class NotificationPostRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/notifications';

    public function __invoke(string $envelopeId, EnvelopeNotificationData $notificationData): RequestInterface
    {
        return $this->createRequestToken('POST', sprintf(self::URI, $envelopeId))
            ->withBody($this->createRequestJsonBody($notificationData->toArray()));
    }
}
