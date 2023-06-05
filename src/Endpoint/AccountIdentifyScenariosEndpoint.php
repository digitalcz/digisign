<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\IdentifyScenario;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<IdentifyScenario>
 * @method ListResource<IdentifyScenario> list(array $query = [])
 * @method IdentifyScenario get(string $id)
 * @method IdentifyScenario create(array $body)
 * @method IdentifyScenario update(string $id, array $body)
 */
class AccountIdentifyScenariosEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<IdentifyScenario> */
    use ListEndpointTrait;
    use CreateEndpointTrait;
    use GetEndpointTrait;
    use UpdateEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/identify-scenarios', IdentifyScenario::class);
    }

    public function versions(IdentifyScenario|string $scenario): AccountIdentifyScenarioVersionsEndpoint
    {
        return new AccountIdentifyScenarioVersionsEndpoint($this, $scenario);
    }
}
