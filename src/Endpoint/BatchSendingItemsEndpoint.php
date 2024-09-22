<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\DeleteEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\BatchSending;
use DigitalCz\DigiSign\Resource\BatchSendingItem;

/**
 * @extends ResourceEndpoint<BatchSendingItem>
 * @method BatchSendingItem get(string $id)
 * @method BatchSendingItem update(string $id, array $body)
 * @method BatchSendingItem delete(string $id)
 */
final class BatchSendingItemsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<BatchSendingItem> */
    use ListEndpointTrait;
    use GetEndpointTrait;
    use UpdateEndpointTrait;
    use DeleteEndpointTrait;

    public function __construct(BatchSendingsEndpoint $parent, BatchSending|string $batchSending)
    {
        parent::__construct(
            $parent,
            '/{batchSending}/items',
            BatchSendingItem::class,
            ['batchSending' => $batchSending],
        );
    }

    /**
     * @param mixed[] $body
     */
    public function import(array $body): void
    {
        $this->postRequest('/import', ['json' => $body]);
    }

    /**
     * @param mixed[] $body
     */
    public function create(array $body): BatchSendingItem
    {
        return $this->makeResource($this->putRequest('', ['json' => $body]));
    }
}
