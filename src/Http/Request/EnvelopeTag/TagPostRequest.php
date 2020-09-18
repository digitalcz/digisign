<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeTag;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeTagData;
use Psr\Http\Message\RequestInterface;

class TagPostRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/tags';

    public function __invoke(string $envelopeId, EnvelopeTagData $tagData): RequestInterface
    {
        return $this->createRequestToken('POST', sprintf(self::URI, $envelopeId))
            ->withBody($this->createRequestJsonBody($tagData->toArray()));
    }
}
