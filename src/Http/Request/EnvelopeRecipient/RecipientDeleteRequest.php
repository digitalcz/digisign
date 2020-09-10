<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeRecipient;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class RecipientDeleteRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/recipients/%s';

    public function __invoke(string $envelopeId, string $recipientId): RequestInterface
    {
        return $this->createRequestToken('DELETE', sprintf(self::URI, $envelopeId, $recipientId));
    }
}
