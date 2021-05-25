<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @template T
 */
trait ListEndpointTrait
{
    /**
     * @param mixed[] $query
     * @return ListResource<T>
     */
    public function list(array $query = []): ListResource
    {
        return $this->makeListRequest($query);
    }
}
