<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\Resource\EnvelopeTag;

/**
 * @extends ResourceEndpoint<EnvelopeTag>
 * @method EnvelopeTag get(string $id)
 * @method EnvelopeTag create(array $body)
 * @method EnvelopeTag update(string $id, array $body)
 */
final class EnvelopeTagsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<EnvelopeTag> */
    use CRUDEndpointTrait;

    /**
     * @param Envelope|string $envelope
     */
    public function __construct(EnvelopesEndpoint $parent, $envelope)
    {
        parent::__construct($parent, '/{envelope}/tags', EnvelopeTag::class, ['envelope' => $envelope]);
    }
}
