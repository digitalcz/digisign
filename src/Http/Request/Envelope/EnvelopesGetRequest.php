<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Envelope;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class EnvelopesGetRequest extends BaseHttpRequest
{

    public const  URI = '/api/envelopes?page=%s&itemsPerPage=%s';

    public function __invoke(int $page, int $itemsPerPage): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $page, $itemsPerPage));
    }
}
