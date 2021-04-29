<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

use DigitalCz\DigiSign\Resource\ListResource;

trait ListEndpointTrait
{
    /**
     * @param mixed[] $query
     */
    public function list(array $query = []): ListResource
    {
        return $this->makeListRequest($query);
    }
}
