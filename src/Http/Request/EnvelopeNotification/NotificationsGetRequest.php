<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeNotification;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class NotificationsGetRequest extends BaseHttpRequest
{

    public const  URI = '/api/envelopes/%s/notifications?page=%s&itemsPerPage=%s';

    public function __invoke(string $envelopeId, int $page, int $itemsPerPage): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $envelopeId, $page, $itemsPerPage));
    }
}
