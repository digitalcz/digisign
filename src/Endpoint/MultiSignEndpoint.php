<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Resource\MultiSign;

/**
 * @extends ResourceEndpoint<MultiSign>
 */
final class MultiSignEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/multi-signs', MultiSign::class);
    }
}
