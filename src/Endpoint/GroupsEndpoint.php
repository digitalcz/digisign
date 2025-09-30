<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Group;

/**
 * @extends ResourceEndpoint<Group>
 * @method Group create(array $body)
 * @method Group get(string $id)
 * @method Group update(string $id, array $body)
 * @method Group[] list(array $query = [])
 */
final class GroupsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Group> */
    use CRUDEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/groups', Group::class);
    }
}
