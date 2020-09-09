<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeDocument;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DocumentsGetRequest extends BaseHttpRequest
{

    public const  URI = '/api/envelopes/%s/documents?page=%s&itemsPerPage=%s';

    public function __invoke(string $envelopeId, int $page, int $itemsPerPage): RequestInterface
    {
        return $this->createRequestToken('GET', sprintf(self::URI, $envelopeId, $page, $itemsPerPage));
    }
}
