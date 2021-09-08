<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\AccountSecurity;

/**
 * @extends ResourceEndpoint<AccountSecurity>
 */
final class AccountSecurityEndpoint extends ResourceEndpoint
{
    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/security', AccountSecurity::class);
    }

    public function get(): AccountSecurity
    {
        return $this->makeResource($this->getRequest());
    }

    /**
     * @param mixed[] $body
     */
    public function update(array $body): AccountSecurity
    {
        return $this->makeResource($this->putRequest('', ['json' => $body]));
    }
}
