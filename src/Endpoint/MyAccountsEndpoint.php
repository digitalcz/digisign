<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\MyAccount;

/**
 * @extends ResourceEndpoint<MyAccount>
 * @method MyAccount create(array $body)
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
        return $this->createCollectionResource($this->getRequest(), MyAccount::class);
    }

    public function accept(string $id): MyAccount
    {
        return $this->makeResource($this->postRequest('/{id}/accept', ['id' => $id]));
    }

    public function decline(string $id): void
    {
        $this->postRequest('/{id}/decline', ['id' => $id]);
    }
}
