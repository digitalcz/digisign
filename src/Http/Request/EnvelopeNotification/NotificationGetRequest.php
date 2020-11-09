<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeNotification;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class NotificationGetRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/notifications/%s';

    public function __invoke(string $envelopeId, string $notificationId): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $envelopeId, $notificationId));
    }
}
