<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\ApiKey;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\User;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class AccountMeEndpoint extends ResourceEndpoint
{
    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/me', BaseResource::class);
    }

    /**
     * @return User|ApiKey
     */
    public function get(): BaseResource
    {
        $result = $this->getRequest();

        // identify resource User/ApiKey
        $resourceClass = isset($result->firstName) ? User::class : ApiKey::class;

        return $this->createResource($result, $resourceClass);
    }

    /**
     * @param mixed[] $body
     */
    public function changePassword(array $body): void
    {
        $this->postRequest('/change-password', ['json' => $body]);
    }

    /**
     * @param mixed[] $body
     */
    public function verifyPassword(array $body): void
    {
        $this->postRequest('/verify-password', ['json' => $body]);
    }
}
