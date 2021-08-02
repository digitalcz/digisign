<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\MyAccount;

/**
 * @extends ResourceEndpoint<MyAccount>
 */
final class MyAccountsEndpoint extends ResourceEndpoint
{
    use CreateEndpointTrait;

    public function __construct(MyEndpoint $parent)
    {
        parent::__construct($parent, '/accounts', MyAccount::class);
    }

    /**
     * @return Collection<MyAccount>
     */
    public function list(): Collection
    {
        return new Collection($this->parseResponse($this->getRequest()));
    }
}
