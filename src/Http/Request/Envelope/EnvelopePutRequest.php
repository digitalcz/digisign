<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\Envelope;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeData;
use Psr\Http\Message\RequestInterface;

class EnvelopePutRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s';

    public function __invoke(string $envelopeId, EnvelopeData $envelopeData): RequestInterface
    {
        return $this->createRequestToken('PUT', sprintf(self::URI, $envelopeId))
            ->withBody(
                $this->createRequestJsonBody($envelopeData->toArray())
            );
    }
}
