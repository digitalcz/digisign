<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeRecipient;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeRecipientData;
use Psr\Http\Message\RequestInterface;

class RecipientPostRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/recipients';

    public function __invoke(string $envelopeId, EnvelopeRecipientData $recipientData): RequestInterface
    {
        return $this->createRequestToken('POST', sprintf(self::URI, $envelopeId))
            ->withBody(
                $this->createRequestJsonBody($recipientData->toArray())
            );
    }
}
