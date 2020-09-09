<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeDocument;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeDocumentData;
use Psr\Http\Message\RequestInterface;

class DocumentPostRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/documents';

    public function __invoke(string $envelopeId, EnvelopeDocumentData $document): RequestInterface
    {
        return $this->createRequestToken('POST', sprintf(self::URI, $envelopeId))
            ->withBody(
                $this->createRequestJsonBody($document->toArray())
            );
    }
}
