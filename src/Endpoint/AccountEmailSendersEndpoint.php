<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\AccountEmailSender;
use DigitalCz\DigiSign\Resource\ListResource;

/**
 * @extends ResourceEndpoint<AccountEmailSender>
 * @method ListResource<AccountEmailSender> list(array $query = [])
 * @method AccountEmailSender get(string $id)
 */
class AccountEmailSendersEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<AccountEmailSender> */
    use ListEndpointTrait;
    use GetEndpointTrait;

    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/email-senders', AccountEmailSender::class);
    }
}
