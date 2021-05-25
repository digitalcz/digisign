<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

/**
 * @template T
 */
trait CRUDEndpointTrait
{
    /** @use ListEndpointTrait<T> */
    use ListEndpointTrait;
    use CreateEndpointTrait;
    use GetEndpointTrait;
    use UpdateEndpointTrait;
    use DeleteEndpointTrait;
}
