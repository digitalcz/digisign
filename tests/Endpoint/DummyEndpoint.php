<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\DummyResource;
use Psr\Http\Message\ResponseInterface;

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

    public function patch(): DummyResource
    {
        return $this->makeResource($this->patchRequest());
    }

    /**
     * @return Collection<DummyResource>
     */
    public function collection(ResponseInterface $response): Collection
    {
        return $this->createCollectionResource($response, DummyResource::class);
    }
}
