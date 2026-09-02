<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Label;

/**
 * @extends ResourceEndpoint<Label>
 * @method Label get(string $id)
 * @method Label create(mixed[] $body)
 * @method Label update(string $id, mixed[] $body)
 */
final class LabelsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Label> */
    use CRUDEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/labels', Label::class);
    }
}
