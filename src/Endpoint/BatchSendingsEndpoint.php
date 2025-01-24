<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\DeleteEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\BatchSending;
use DigitalCz\DigiSign\Resource\BatchSendingStats;
use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\ListResource;
use DigitalCz\DigiSign\Resource\MultiSignRecipientInfo;

/**
 * @extends ResourceEndpoint<BatchSending>
 * @method BatchSending get(string $id)
 * @method BatchSending update(string $id, array $body)
 * @method BatchSending create(array $body)
 * @method BatchSending delete(string $id)
 * @method ListResource<BatchSending> list(array $query)
 */
final class BatchSendingsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<BatchSending> */
    use ListEndpointTrait;
    use GetEndpointTrait;
    use UpdateEndpointTrait;
    use CreateEndpointTrait;
    use DeleteEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/batch-sendings');
    }

    public function items(BatchSending|string $id): BatchSendingItemsEndpoint
    {
        return new BatchSendingItemsEndpoint($this, $id);
    }

    public function send(BatchSending|string $id): BaseResource
    {
        return $this->makeResource($this->postRequest('/{id}/send', ['id' => $id]));
    }

    public function stats(BatchSending|string $id): BatchSendingStats
    {
        return $this->createResource($this->getRequest('/{id}/stats', ['id' => $id]), BatchSendingStats::class);
    }

    /**
     * @return Collection<MultiSignRecipientInfo>
     */
    public function multiSignRecipients(BatchSending|string $id): Collection
    {
        return $this->createCollectionResource(
            $this->getRequest('/{id}/multi-sign-recipients', ['id' => $id]),
            MultiSignRecipientInfo::class,
        );
    }
}
