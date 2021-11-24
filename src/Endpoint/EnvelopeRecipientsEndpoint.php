<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\Resource\EnvelopeRecipient;
use DigitalCz\DigiSign\Resource\EnvelopeRecipientAttachment;
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
    /** @use CRUDEndpointTrait<EnvelopeRecipient> */
    use CRUDEndpointTrait;

    /**
     * @param Envelope|string $envelope
     */
    public function __construct(EnvelopesEndpoint $parent, $envelope)
    {
        parent::__construct($parent, '/{envelope}/recipients', EnvelopeRecipient::class, ['envelope' => $envelope]);
    }

    /**
     * @param EnvelopeRecipient|string $recipient
     */
    public function block($recipient): RecipientBlockEndpoint
    {
        return new RecipientBlockEndpoint($this, $recipient);
    }

    /**
     * @param mixed[] $body
     * @return array<EnvelopeRecipient>
     */
    public function createMany(array $body): array
    {
        $response = $this->patchRequest('', ['json' => $body]);
        $result = $this->parseResponse($response);

        return array_map(static function (array $recipientResult): EnvelopeRecipient {
            return new EnvelopeRecipient($recipientResult);
        }, $result);
    }

    /**
     * @param mixed[] $body
     */
    public function embed(string $id, array $body): ResourceInterface
    {
        return $this->createResource(
            $this->postRequest('/{id}/embed', ['id' => $id, 'json' => $body])
        );
    }

    /**
     * @param mixed[] $query
     * @return ListResource<EnvelopeTag>
     */
    public function tags(string $id, array $query = []): ListResource
    {
        return $this->createListResource(
            $this->getRequest('/{id}/tags', ['id' => $id, 'query' => $query]),
            EnvelopeTag::class
        );
    }

    public function resend(string $id): ResourceInterface
    {
        return $this->createResource($this->postRequest('/{id}/resend', ['id' => $id]));
    }

    public function verifiedClaims(string $id): ResourceInterface
    {
        return $this->createResource($this->getRequest('/{id}/verified-claims', ['id' => $id]), VerifiedClaims::class);
    }

    /**
     * @param mixed[] $body
     */
    public function signingOrder(array $body): void
    {
        $this->putRequest('/signing-order', ['json' => $body]);
    }

    /**
     * @return Collection<EnvelopeRecipientAttachment>
     */
    public function attachments(): Collection
    {
        return $this->createCollectionResource($this->getRequest('/attachments'), EnvelopeRecipientAttachment::class);
    }
}
