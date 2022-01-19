<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\Label;

/**
 * @extends ResourceEndpoint<Label>
 * @method ListResource<Label> list(array $query = [])
 * @method Label get(string $id)
 * @method Label create(array $body)
 * @method Label update(string $id, array $body)
 */
final class LabelsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<Label> */
    use ListEndpointTrait;
    use GetEndpointTrait;
    use CreateEndpointTrait;
    use UpdateEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/labels', Label::class);
    }
}
