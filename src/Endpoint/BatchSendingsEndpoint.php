<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\DeleteEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\BatchSending;

/**
 * @extends ResourceEndpoint<BatchSending>
 * @method BatchSending get(string $id)
 * @method BatchSending update(string $id, array $body)
 * @method BatchSending create(array $body)
 * @method BatchSending delete(string $id)
 */
final class BatchSendingsEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;
    use UpdateEndpointTrait;
    use CreateEndpointTrait;
    use DeleteEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/batch-sendings');
    }

    public function items(string $id): BatchSendingsItemsEndpoint
    {
        return new BatchSendingsItemsEndpoint($this, $id);
    }
}
