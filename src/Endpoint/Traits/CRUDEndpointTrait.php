<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

trait CRUDEndpointTrait
{
    use ListEndpointTrait;
    use CreateEndpointTrait;
    use GetEndpointTrait;
    use UpdateEndpointTrait;
    use DeleteEndpointTrait;
}
