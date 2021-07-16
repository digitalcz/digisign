<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\MyDashboard;

/**
 * @extends ResourceEndpoint<MyDashboard>
 */
final class MyDashboardEndpoint extends ResourceEndpoint
{
    public function __construct(MyEndpoint $parent)
    {
        parent::__construct($parent, '/dashboard', MyDashboard::class);
    }

    public function get(): MyDashboard
    {
        return $this->makeResource($this->getRequest());
    }
}
