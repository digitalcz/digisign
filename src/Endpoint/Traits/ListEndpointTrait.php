<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint\Traits;

use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @template T
 */
trait ListEndpointTrait
{
    /**
     * `_actions` / `_links` already present in $query take precedence over the arguments and are sent once.
     *
     * @param mixed[] $query
     * @param bool $actions Include `_actions` on each item (set false to speed up large lists)
     * @param bool $links Include `_links` on each item
     * @return ListResource<T>
     */
    public function list(array $query = [], bool $actions = true, bool $links = true): ListResource
    {
        return $this->makeListRequest($query + self::halQuery($actions, $links));
    }
}
