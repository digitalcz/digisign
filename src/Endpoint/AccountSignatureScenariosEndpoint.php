<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
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
    /** @use CRUDEndpointTrait<SignatureScenario> */
    use CRUDEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/signature-scenarios', SignatureScenario::class);
    }
}
