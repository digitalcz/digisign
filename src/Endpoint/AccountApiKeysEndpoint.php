<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\ApiKey;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<ApiKey>
 * @method ListResource<ApiKey> list(mixed[] $query = [])
 * @method ApiKey get(string $id)
 * @method ApiKey create(mixed[] $body)
 * @method ApiKey update(string $id, mixed[] $body)
 */
final class AccountApiKeysEndpoint extends ResourceEndpoint
{
    use CreateEndpointTrait;
    use GetEndpointTrait;
    /** @use ListEndpointTrait<ApiKey> */
    use ListEndpointTrait;
    use UpdateEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/api-keys', ApiKey::class);
    }

    public function activate(string $id): ApiKey
    {
        return $this->makeResource($this->postRequest('/{id}/activate', ['id' => $id]));
    }

    public function deactivate(string $id): ApiKey
    {
        return $this->makeResource($this->postRequest('/{id}/deactivate', ['id' => $id]));
    }
}
