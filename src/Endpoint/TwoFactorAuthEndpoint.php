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

    /**
     * @param mixed[] $body
     */
    public function disable(array $body): void
    {
        $this->deleteRequest('', ['json' => $body]);
    }
}
