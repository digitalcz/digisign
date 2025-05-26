<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\User;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class TwoFactorAuthEndpoint extends ResourceEndpoint
{
    public function __construct(AccountUsersEndpoint $parent, User|string $user)
    {
        parent::__construct(
            $parent,
            '/{user}/2fa',
            BaseResource::class,
            ['user' => $user],
        );
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

    /**
     * @param mixed[] $body
     */
    public function reset(array $body): void
    {
        $this->postRequest('/reset', ['json' => $body]);
    }
}
