<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

use DigitalCz\DigiSign\Resource\ResourceInterface;

trait CreateEndpointTrait
{
    /**
     * @param mixed[] $body
     */
    public function create(array $body): ResourceInterface
    {
        return $this->makeCreateRequest($body);
    }
}
