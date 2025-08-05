<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BulkSignature;
use DigitalCz\DigiSign\Resource\EmbedBulkSignature;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<BulkSignature>
 */
final class MyBulkSignaturesEndpoint extends ResourceEndpoint
{
    public function __construct(MyEndpoint $parent)
    {
        parent::__construct($parent, '/bulk-signatures', BulkSignature::class);
    }

    /**
     * @param mixed[] $query
     * @return ListResource<BulkSignature>
     */
    public function listToSign(array $query = []): ListResource
    {
        return $this->makeListResource($this->getRequest('/to-sign', ['query' => $query]));
    }

    public function sign(BulkSignature|string $bulkSignature): EmbedBulkSignature
    {
        return $this->createResource(
            $this->getRequest('/{bulkSignature}/sign', ['bulkSignature' => $bulkSignature]),
            EmbedBulkSignature::class,
        );
    }
}
