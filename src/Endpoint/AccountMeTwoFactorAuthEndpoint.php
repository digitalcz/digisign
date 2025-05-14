<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\TwoFactorAuth;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class AccountMeTwoFactorAuthEndpoint extends ResourceEndpoint
{
    public function __construct(AccountMeEndpoint $parent)
    {
        parent::__construct($parent, '/2fa');
    }

    public function get(): TwoFactorAuth
    {
        return $this->createResource($this->getRequest(), TwoFactorAuth::class);
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
