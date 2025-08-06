<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BulkSignature;
use DigitalCz\DigiSign\Resource\ListResource;
use DigitalCz\DigiSign\Resource\UserBulkSignEnvelope;

/**
 * @extends ResourceEndpoint<UserBulkSignEnvelope>
 */
final class MyBulkSignEndpoint extends ResourceEndpoint
{
    public function __construct(MyEndpoint $parent)
    {
        parent::__construct($parent, '/bulk-sign', UserBulkSignEnvelope::class);
    }

    /**
     * @param mixed[] $query
     * @return ListResource<UserBulkSignEnvelope>
     */
    public function envelopes(array $query = []): ListResource
    {
        return $this->makeListResource($this->getRequest('/envelopes', ['query' => $query]));
    }

    /**
     * @param mixed[] $query
     * @return ListResource<BulkSignature>
     */
    public function bulkSignatures(array $query = []): ListResource
    {
        return $this->createListResource(
            $this->getRequest('/bulk-signatures', ['query' => $query]),
            BulkSignature::class,
        );
    }
}
