<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeTag;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class TagsGetRequest extends BaseHttpRequest
{

    public const  URI = '/api/envelopes/%s/tags?page=%s&itemsPerPage=%s';

    public function __invoke(string $envelopeId, int $page, int $itemsPerPage): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $envelopeId, $page, $itemsPerPage));
    }
}
