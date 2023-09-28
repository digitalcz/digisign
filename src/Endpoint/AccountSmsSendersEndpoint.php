<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\AccountSmsSender;
use DigitalCz\DigiSign\Resource\Branding;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<AccountSmsSender>
 * @method ListResource<AccountSmsSender> list(array $query = [])
 * @method AccountSmsSender get(string $id)
 */
class AccountSmsSendersEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<AccountSmsSender> */
    use ListEndpointTrait;
    use GetEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/sms-senders', AccountSmsSender::class);
    }
}
