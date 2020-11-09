<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeNotification;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeNotificationData;
use Psr\Http\Message\RequestInterface;

class NotificationPutRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/notifications/%s';

    public function __invoke(
        string $envelopeId,
        string $tagId,
        EnvelopeNotificationData $notificationData
    ): RequestInterface {

        return $this->createRequestToken('PUT', sprintf(self::URI, $envelopeId, $tagId))
            ->withBody(
                $this->createRequestJsonBody($notificationData->toArray())
            );
    }
}
