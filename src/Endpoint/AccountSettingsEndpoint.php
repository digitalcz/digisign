<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\AccountSettings;

/**
 * @extends ResourceEndpoint<AccountSettings>
 */
final class AccountSettingsEndpoint extends ResourceEndpoint
{
    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/settings', AccountSettings::class);
    }

    public function get(): AccountSettings
    {
        return $this->makeResource($this->getRequest());
    }

    /**
     * @param mixed[] $body
     */
    public function update(array $body): AccountSettings
    {
        return $this->makeResource($this->putRequest('', ['json' => $body]));
    }
}
