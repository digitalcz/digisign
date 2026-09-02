<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Group;

/**
 * @extends ResourceEndpoint<Group>
 * @method Group create(mixed[] $body)
 * @method Group get(string $id)
 * @method Group update(string $id, mixed[] $body)
 * @method Group[] list(mixed[] $query = [])
 */
final class GroupsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Group> */
    use CRUDEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/groups', Group::class);
    }

    public function users(Group|string $group): GroupUsersEndpoint
    {
        return new GroupUsersEndpoint($this, $group);
    }
}
