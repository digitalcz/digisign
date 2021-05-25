<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

use DigitalCz\DigiSign\Resource\ResourceInterface;

trait GetEndpointTrait
{
    public function get(string $id): ResourceInterface
    {
        return $this->makeGetRequest($id);
    }
}
