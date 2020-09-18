<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http\Request\EnvelopeTag;

use DigitalCz\DigiSign\Http\Request\BaseHttpRequest;
use Psr\Http\Message\RequestInterface;

class TagDeleteRequest extends BaseHttpRequest
{

    public const URI = '/api/envelopes/%s/tags/%s';

    public function __invoke(string $envelopeId, string $tagId): RequestInterface
    {
        return $this->createRequestToken('DELETE', sprintf(self::URI, $envelopeId, $tagId));
    }
}
