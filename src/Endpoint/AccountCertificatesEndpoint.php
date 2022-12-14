<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\DeleteEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\Certificate;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<Certificate>
 * @method ListResource<Certificate> list(array $query = [])
 * @method Certificate get(string $id)
 * @method Certificate create(array $body)
 */
class AccountCertificatesEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<Certificate> */
    use ListEndpointTrait;
    use GetEndpointTrait;
    use CreateEndpointTrait;
    use DeleteEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/certificates', Certificate::class);
    }

    public function reload(Certificate|string $id): Certificate
    {
        return $this->makeResource($this->postRequest('/{id}/reload', ['id' => $id]));
    }

    public function disable(Certificate|string $id): Certificate
    {
        return $this->makeResource($this->postRequest('/{id}/disable', ['id' => $id]));
    }

    public function enable(Certificate|string $id): Certificate
    {
        return $this->makeResource($this->postRequest('/{id}/enable', ['id' => $id]));
    }
}
