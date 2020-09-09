<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeDocument;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class DocumentDeleteRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/documents/%s';

    public function __invoke(string $envelopeId, string $documentId): RequestInterface
    {
        return $this->createRequestToken('DELETE', sprintf(self::URI, $envelopeId, $documentId));
    }
}
