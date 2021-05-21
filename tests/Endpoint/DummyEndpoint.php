<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\DummyResource;

/**
 * @extends ResourceEndpoint<DummyResource>
 */
class DummyEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<DummyResource> */
    use CRUDEndpointTrait;

    public function __construct(EndpointInterface $parent)
    {
        parent::__construct($parent, '/dummy', DummyResource::class);
    }

    public function patch(string $id)
    {
        return $this->createResource($this->patchRequest());
    }
}
