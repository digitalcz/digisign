<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\Group;

/**
 * @extends ResourceEndpoint<Group>
 */
final class GroupUsersEndpoint extends ResourceEndpoint
{
    public function __construct(GroupsEndpoint $parent, Group|string $group)
    {
        parent::__construct($parent, '/{group}/users', Group::class, ['group' => $group]);
    }

    /**
     * @param mixed[] $body
     */
    public function add(array $body): void
    {
        $this->postRequest('', ['json' => $body]);
    }

    /**
     * @param mixed[] $body
     */
    public function delete(array $body): void
    {
        $this->deleteRequest('', ['json' => $body]);
    }
}
