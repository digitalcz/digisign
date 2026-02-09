<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\UpdateEndpointTrait;
use DigitalCz\DigiSign\Resource\BillingProfile;

/**
 * @extends ResourceEndpoint<BillingProfile>
 * @method BillingProfile get(string $id)
 * @method BillingProfile update(string $id, array $body)
 */
final class BillingProfileEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;
    use UpdateEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/billing-profile', BillingProfile::class);
    }
}
