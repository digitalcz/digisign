<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeRecipient;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeRecipientData;
use Psr\Http\Message\RequestInterface;

class RecipientPutRequest extends BaseHttpRequest
{
    public const URI = '/api/envelopes/%s/recipients/%s';

    public function __invoke(string $envelopeId, string $documentId, EnvelopeRecipientData $document): RequestInterface
    {
        return $this->createRequestToken('PUT', sprintf(self::URI, $envelopeId, $documentId))
            ->withBody(
                $this->createRequestJsonBody($document->toArray())
            );
    }
}
