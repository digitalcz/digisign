<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Delivery;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DeliveriesGetRequest extends BaseHttpRequest
{

    public const  URI = '/api/deliveries?page=%s&itemsPerPage=%s';

    public function __invoke(int $page, int $itemsPerPage): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $page, $itemsPerPage));
    }
}
