<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\AccountRequest;

/**
 * @extends ResourceEndpoint<AccountRequest>
 * @method AccountRequest get(string $id)
 */
final class AccountRequestsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<AccountRequest> */
    use ListEndpointTrait;
    use GetEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/requests', AccountRequest::class);
    }
}
