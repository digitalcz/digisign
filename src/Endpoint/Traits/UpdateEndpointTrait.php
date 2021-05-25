<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

use DigitalCz\DigiSign\Resource\ResourceInterface;

trait UpdateEndpointTrait
{
    /**
     * @param mixed[] $body
     */
    public function update(string $id, array $body): ResourceInterface
    {
        return $this->makeUpdateRequest($id, $body);
    }
}
