<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\EnvelopeTag;

/**
 * @extends ResourceEndpoint<EnvelopeTag>
 */
final class EnvelopeTagsByPlaceholder extends ResourceEndpoint
{
    public function __construct(EnvelopeTagsEndpoint $parent)
    {
        parent::__construct($parent, '/by-placeholder', EnvelopeTag::class);
    }

    /**
     * @param mixed[] $body
     * @return Collection<EnvelopeTag>
     */
    public function create(array $body): Collection
    {
        return $this->createCollectionResource($this->postRequest('', ['json' => $body]), EnvelopeTag::class);
    }
}
