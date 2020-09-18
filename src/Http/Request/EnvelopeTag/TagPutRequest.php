<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeTag;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use DigitalCz\DigiSign\Model\DTO\EnvelopeTagData;
use Psr\Http\Message\RequestInterface;

class TagPutRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/tags/%s';

    public function __invoke(string $envelopeId, string $tagId, EnvelopeTagData $tagData): RequestInterface
    {
        return $this->createRequestToken('PUT', sprintf(self::URI, $envelopeId, $tagId))
            ->withBody(
                $this->createRequestJsonBody($tagData->toArray())
            );
    }
}
