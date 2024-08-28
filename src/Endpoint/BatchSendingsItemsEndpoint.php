<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BaseResource;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class BatchSendingsItemsEndpoint extends ResourceEndpoint
{
    public function __construct(BatchSendingsEndpoint $parent, string $batchSending)
    {
        parent::__construct($parent, '/{id}/items', BaseResource::class, ['id' => $batchSending]);
    }

    /**
     * @param mixed[] $body
     */
    public function import(array $body): BaseResource
    {
        return $this->createResource($this->postRequest('/import', ['json' => $body]));
    }
}
