<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

/**
 * @template T
 */
trait CRUDEndpointTrait
{
    use CreateEndpointTrait;
    use DeleteEndpointTrait;
    use GetEndpointTrait;
    /** @use ListEndpointTrait<T> */
    use ListEndpointTrait;
    use UpdateEndpointTrait;
}
