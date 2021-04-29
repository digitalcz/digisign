<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\StreamResponse;

/**
 * @extends ResourceEndpoint<Envelope>
 * @method Envelope get(string $id)
 * @method Envelope create(array $body)
 * @method Envelope update(string $id, array $body)
 */
final class EnvelopesEndpoint extends ResourceEndpoint
{
    use CRUDEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/envelopes', Envelope::class);
    }

    public function documents(string $id): EnvelopeDocumentsEndpoint
    {
        return new EnvelopeDocumentsEndpoint($this, $id);
    }

    public function recipients(string $id): EnvelopeRecipientsEndpoint
    {
        return new EnvelopeRecipientsEndpoint($this, $id);
    }

    public function tags(string $id): EnvelopeTagsEndpoint
    {
        return new EnvelopeTagsEndpoint($this, $id);
    }

    public function notifications(string $id): EnvelopeNotificationsEndpoint
    {
        return new EnvelopeNotificationsEndpoint($this, $id);
    }

    public function cancel(string $id): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/cancel', ['id' => $id]), BaseResource::class);
    }

    public function count(): BaseResource
    {
        return $this->createResource($this->getRequest('/count'), BaseResource::class);
    }

    /**
     * @param mixed[] $query
     */
    public function download(string $id, array $query = []): StreamResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/download', ['id' => $id, 'query' => $query]);
    }

    public function embedEdit(string $id): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/embed/edit', ['id' => $id]), BaseResource::class);
    }

    /**
     * @param mixed[] $body
     */
    public function extend(string $id, array $body): Envelope
    {
        return $this->createResource(
            $this->putRequest('/{id}/extend', ['id' => $id, 'json' => $body]),
            $this->getResourceClass(),
        );
    }

    public function send(string $id): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/send', ['id' => $id]), BaseResource::class);
    }
}
