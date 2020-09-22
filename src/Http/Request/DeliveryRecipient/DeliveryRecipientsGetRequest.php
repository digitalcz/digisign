<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\DeliveryRecipient;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DeliveryRecipientsGetRequest extends BaseHttpRequest
{

    public const  URI = '/api/deliveries/%s/recipients?page=%s&itemsPerPage=%s';

    public function __invoke(string $deliveryId, int $page, int $itemsPerPage): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $deliveryId, $page, $itemsPerPage));
    }
}
