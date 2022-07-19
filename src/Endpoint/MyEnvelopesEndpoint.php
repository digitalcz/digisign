<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\ListResource;
use DigitalCz\DigiSign\Resource\MyEnvelope;
use DigitalCz\DigiSign\Resource\MyEnvelopeInfo;

/**
 * @extends ResourceEndpoint<MyEnvelope>
 */
final class MyEnvelopesEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<MyEnvelope> */
    use ListEndpointTrait;
    use GetEndpointTrait;

    public function __construct(MyEndpoint $parent)
    {
        parent::__construct($parent, '/envelopes', MyEnvelope::class);
    }

    /**
     * @param mixed[] $query
     * @return ListResource<MyEnvelope>
     */
    public function listToSign(array $query): ListResource
    {
        return $this->makeListResource($this->getRequest('/to-sign', ['query' => $query]));
    }

    /**
     * @param mixed[] $query
     * @return ListResource<MyEnvelope>
     */
    public function listWaitingForOthers(array $query = []): ListResource
    {
        return $this->makeListResource($this->getRequest('/waiting-for-others', ['query' => $query]));
    }

    public function info(string $id): MyEnvelopeInfo
    {
        return $this->createResource($this->getRequest('/{id}/info', ['id' => $id]), MyEnvelopeInfo::class);
    }
}
