<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\BatchSending;
use DigitalCz\DigiSign\Resource\BatchSendingItem;

/**
 * @extends ResourceEndpoint<BatchSendingItem>
 * @method BatchSendingItem get(string $id)
 * @method BatchSendingItem create(array $body)
 * @method BatchSendingItem update(string $id, array $body)
 */
final class BatchSendingItemsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<BatchSendingItem> */
    use CRUDEndpointTrait;

    public function __construct(BatchSendingsEndpoint $parent, BatchSending|string $batchSending)
    {
        parent::__construct($parent, '/{id}/items', BatchSendingItem::class, ['id' => $batchSending]);
    }

    /**
     * @param mixed[] $body
     */
    public function import(array $body): void
    {
        $this->postRequest('/import', ['json' => $body]);
    }
}
