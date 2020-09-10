<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeDocument;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeDocumentData;
use Psr\Http\Message\RequestInterface;

class DocumentPutRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/documents/%s';

    public function __invoke(string $envelopeId, string $documentId, EnvelopeDocumentData $document): RequestInterface
    {
        return $this->createRequestToken('PUT', sprintf(self::URI, $envelopeId, $documentId))
            ->withBody(
                $this->createRequestJsonBody($document->toArray())
            );
    }
}
