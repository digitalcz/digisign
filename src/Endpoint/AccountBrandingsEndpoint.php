<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Branding;
use DigitalCz\DigiSign\Resource\BrandingInfo;
use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<Branding>
 * @method ListResource<Branding> list(array $query = [])
 * @method Branding get(string $id)
 * @method Branding create(array $body)
 * @method Branding update(string $id, array $body)
 */
class AccountBrandingsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Branding> */
    use CRUDEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/brandings', Branding::class);
    }

    /**
     * @return Collection<BrandingInfo>
     */
    public function info(): Collection
    {
        return $this->createCollectionResource($this->getRequest('/info'), BrandingInfo::class);
    }
}
