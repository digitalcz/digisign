<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\ApiKey;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\ResourceInterface;
use DigitalCz\DigiSign\Resource\User;
use DigitalCz\DigiSign\Stream\FileResponse;

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
    public function get(): ResourceInterface
    {
        $response = $this->getRequest();
        $result = $this->parseResponse($response);

        // identify resource User/ApiKey
        $resourceClass = isset($result['firstName']) ? User::class : ApiKey::class;

        return $this->createResource($response, $resourceClass);
    }

    /**
     * @param mixed[] $body
     * @return User
     */
    public function update(array $body): User
    {
        return $this->createResource($this->putRequest('', ['json' => $body]), User::class);
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

    public function signatureImageContent(): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/signature-image/content');
    }
}
