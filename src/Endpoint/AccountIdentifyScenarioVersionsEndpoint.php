<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\IdentifyScenario;
use DigitalCz\DigiSign\Resource\IdentifyScenarioVersion;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<IdentifyScenarioVersion>
 * @method ListResource<IdentifyScenarioVersion> list(array $query = [])
 * @method IdentifyScenarioVersion get(string $id)
 * @method IdentifyScenarioVersion create(array $body)
 */
class AccountIdentifyScenarioVersionsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<IdentifyScenarioVersion> */
    use ListEndpointTrait;
    use CreateEndpointTrait;
    use GetEndpointTrait;

    public function __construct(AccountIdentifyScenariosEndpoint $parent, IdentifyScenario|string $scenario)
    {
        parent::__construct(
            $parent,
            '/{scenario}/versions',
            IdentifyScenarioVersion::class,
            ['scenario' => $scenario],
        );
    }

    public function latest(): IdentifyScenarioVersion
    {
        return $this->makeResource($this->getRequest('/latest'));
    }
}
