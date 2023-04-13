<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\ListResource;
use DigitalCz\DigiSign\Resource\SignatureScenario;

/**
 * @extends ResourceEndpoint<SignatureScenario>
 * @method ListResource<SignatureScenario> list(array $query = [])
 * @method SignatureScenario get(string $id)
 * @method SignatureScenario create(array $body)
 * @method SignatureScenario update(string $id, array $body)
 */
class AccountSignatureScenariosEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<SignatureScenario> */
    use ListEndpointTrait;
    use CreateEndpointTrait;
    use GetEndpointTrait;
    use UpdateEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/signature-scenarios', SignatureScenario::class);
    }

    public function versions(SignatureScenario|string $scenario): AccountSignatureScenarioVersionsEndpoint
    {
        return new AccountSignatureScenarioVersionsEndpoint($this, $scenario);
    }
}
