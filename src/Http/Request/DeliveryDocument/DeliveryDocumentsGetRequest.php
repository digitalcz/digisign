<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\DeliveryDocument;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DeliveryDocumentsGetRequest extends BaseHttpRequest
{

    public const  URI = '/api/deliveries/%s/documents?page=%s&itemsPerPage=%s';

    public function __invoke(string $deliveryId, int $page, int $itemsPerPage): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $deliveryId, $page, $itemsPerPage));
    }
}
