<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\BatchSending;

/**
 * @extends ResourceEndpoint<BatchSending>
 */
final class BatchSendingsEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;
    use UpdateEndpointTrait;
    use CreateEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/batch-sendings');
    }

    public function items(string $id): BatchSendingsItemsEndpoint
    {
        return new BatchSendingsItemsEndpoint($this, $id);
    }
}
