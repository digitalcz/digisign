<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Envelope;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class EnvelopeCancelPostRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/cancel';

    public function __invoke(string $envelopeId): RequestInterface
    {
        return $this->createRequestToken('POST', sprintf(self::URI, $envelopeId));
    }
}
