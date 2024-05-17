<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\User;

/**
 * @extends ResourceEndpoint<User>
 * @method User get(string $id)
 * @method User update(string $id, array $body)
 */
final class AccountUsersEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<User> */
    use ListEndpointTrait;
    use GetEndpointTrait;
    use UpdateEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/users', User::class);
    }

    public function activate(string $id): void
    {
        $this->postRequest('/{id}/activate', ['id' => $id]);
    }

    public function deactivate(string $id): void
    {
        $this->postRequest('/{id}/deactivate', ['id' => $id]);
    }

    public function disinvite(string $id): void
    {
        $this->postRequest('/{id}/disinvite', ['id' => $id]);
    }

    /**
     * @param mixed[] $body
     */
    public function invite(array $body): User
    {
        return $this->makeResource($this->postRequest('/invite', ['input' => $body]));
    }

    public function reinvite(string $id): User
    {
        return $this->makeResource($this->postRequest('/{id}/reinvite', ['id' => $id]));
    }
}
