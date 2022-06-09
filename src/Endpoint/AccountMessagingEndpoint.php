<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\AccountMessaging;

/**
 * @extends ResourceEndpoint<AccountMessaging>
 */
class AccountMessagingEndpoint extends ResourceEndpoint
{
    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/messaging', AccountMessaging ::class);
    }

    public function get(): AccountMessaging
    {
        return $this->makeResource($this->getRequest());
    }

    /**
     * @param mixed[] $body
     */
    public function update(array $body): AccountMessaging
    {
        return $this->makeResource($this->putRequest('', ['json' => $body]));
    }
}
