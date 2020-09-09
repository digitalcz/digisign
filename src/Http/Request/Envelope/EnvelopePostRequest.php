<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Envelope;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeData;
use Psr\Http\Message\RequestInterface;

class EnvelopePostRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes';

    public function __invoke(EnvelopeData $envelopeData): RequestInterface
    {
        return $this->createRequestToken('POST', self::URI)
            ->withBody(
                $this->createRequestJsonBody($envelopeData->toArray())
            );
    }
}
