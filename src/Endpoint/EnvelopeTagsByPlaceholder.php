<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Resource\EnvelopeTag;

/**
 * @extends ResourceEndpoint<EnvelopeTag>
 * @method EnvelopeTag[] create(array $body)
 */
final class EnvelopeTagsByPlaceholder extends ResourceEndpoint
{
    use CreateEndpointTrait;

    public function __construct(EnvelopeTagsEndpoint $parent)
    {
        parent::__construct($parent, '/by-placeholder', EnvelopeTag::class);
    }
}
