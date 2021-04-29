<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\EnvelopeTag;

/**
 * @extends ResourceEndpoint<EnvelopeTag>
 * @method EnvelopeTag get(string $id)
 * @method EnvelopeTag create(array $body)
 * @method EnvelopeTag update(string $id, array $body)
 */
final class EnvelopeTagsEndpoint extends ResourceEndpoint
{
    use CRUDEndpointTrait;

    public function __construct(EnvelopesEndpoint $parent, string $envelope)
    {
        parent::__construct($parent, '/{envelope}/tags', EnvelopeTag::class, ['envelope' => $envelope]);
    }
}
