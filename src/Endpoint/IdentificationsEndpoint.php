<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Identification;

/**
 * @extends ResourceEndpoint<Identification>
 * @method Identification get(string $id)
 * @method Identification create(array $body)
 * @method Identification update(string $id, array $body)
 */
final class IdentificationsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Identification> */
    use CRUDEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/identifications', Identification::class);
    }

    public function approve(Identification|string $id): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/approve', ['id' => $id]));
    }

    /**
     * @param mixed[] $body
     */
    public function deny(Identification|string $id, array $body = []): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/deny', ['id' => $id, 'json' => $body]));
    }

    public function cancel(Identification|string $id): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/cancel', ['id' => $id]));
    }

    /**
     * @param mixed[] $body
     */
    public function discard(Identification|string $id, array $body = []): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/discard', ['id' => $id, 'json' => $body]));
    }

    public function restore(Identification|string $id): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/restore', ['id' => $id]));
    }
}
