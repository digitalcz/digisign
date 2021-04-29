<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

trait DeleteEndpointTrait
{
    public function delete(string $id): void
    {
        $this->makeDeleteRequest($id);
    }
}
