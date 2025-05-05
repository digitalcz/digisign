<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BaseResource;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class AccountMeTwoFactorAuthEndpoint extends ResourceEndpoint
{
    public function __construct(AccountMeEndpoint $parent)
    {
        parent::__construct($parent, '/2fa');
    }

    /**
     * @param mixed[] $body
     */
    public function configure(array $body): void
    {
        $this->postRequest('', ['json' => $body]);
    }

    public function disable(): void
    {
        $this->deleteRequest();
    }
}
