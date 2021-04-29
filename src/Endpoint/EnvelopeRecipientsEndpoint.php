<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\EnvelopeRecipient;
use DigitalCz\DigiSign\Resource\EnvelopeTag;
use DigitalCz\DigiSign\Resource\ListResource;
use DigitalCz\DigiSign\Resource\ResourceInterface;
use DigitalCz\DigiSign\Resource\VerifiedClaims;

/**
 * @extends ResourceEndpoint<EnvelopeRecipient>
 * @method EnvelopeRecipient get(string $id)
 * @method EnvelopeRecipient create(array $body)
 * @method EnvelopeRecipient update(string $id, array $body)
 */
final class EnvelopeRecipientsEndpoint extends ResourceEndpoint
{
    use CRUDEndpointTrait;

    public function __construct(EnvelopesEndpoint $parent, string $envelope)
    {
        parent::__construct($parent, '/{envelope}/recipients', EnvelopeRecipient::class, ['envelope' => $envelope]);
    }

    public function block(string $id): RecipientBlockEndpoint
    {
        return new RecipientBlockEndpoint($this, $id);
    }

    /**
     * @param mixed[] $body
     * @return array<EnvelopeRecipient>
     */
    public function createMany(array $body): array
    {
        $response = $this->patchRequest('', ['json' => $body]);
        $result = $this->parseResponse($response);

        return array_map(static fn (array $recipientResult) => new EnvelopeRecipient($recipientResult), $result);
    }

    /**
     * @param mixed[] $body
     */
    public function embed(string $id, array $body): ResourceInterface
    {
        return $this->createResource(
            $this->postRequest('/{id}/embed', ['id' => $id, 'json' => $body]),
            BaseResource::class,
        );
    }

    /**
     * @param mixed[] $query
     */
    public function tags(string $id, array $query = []): ListResource
    {
        return $this->createListResource(
            $this->getRequest('/{id}/tags', ['id' => $id, 'query' => $query]),
            EnvelopeTag::class,
        );
    }

    public function resend(string $id): ResourceInterface
    {
        return $this->createResource($this->postRequest('/{id}/resend', ['id' => $id]), BaseResource::class);
    }

    public function verifiedClaims(string $id): ResourceInterface
    {
        return $this->createResource($this->getRequest('/{id}/verified-claims', ['id' => $id]), VerifiedClaims::class);
    }
}
