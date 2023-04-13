<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\ListResource;
use DigitalCz\DigiSign\Resource\SignatureScenario;
use DigitalCz\DigiSign\Resource\SignatureScenarioVersion;

/**
 * @extends ResourceEndpoint<SignatureScenarioVersion>
 * @method ListResource<SignatureScenarioVersion> list(array $query = [])
 * @method SignatureScenarioVersion get(string $id)
 * @method SignatureScenarioVersion create(array $body)
 */
class AccountSignatureScenarioVersionsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<SignatureScenarioVersion> */
    use ListEndpointTrait;
    use CreateEndpointTrait;
    use GetEndpointTrait;

    public function __construct(AccountSignatureScenariosEndpoint $parent, SignatureScenario|string $scenario)
    {
        parent::__construct(
            $parent,
            '/{scenario}/versions',
            SignatureScenarioVersion::class,
            ['scenario' => $scenario],
        );
    }

    public function latest(): SignatureScenarioVersion
    {
        return $this->makeResource($this->getRequest('/latest'));
    }
}
