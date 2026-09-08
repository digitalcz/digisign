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
 * @method ListResource<Certificate> list(mixed[] $query = [])
 * @method Certificate get(string $id)
 * @method Certificate create(mixed[] $body)
 */
class AccountCertificatesEndpoint extends ResourceEndpoint
{
    use CreateEndpointTrait;
    use DeleteEndpointTrait;
    use GetEndpointTrait;
    /** @use ListEndpointTrait<Certificate> */
    use ListEndpointTrait;

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
