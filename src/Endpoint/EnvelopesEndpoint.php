<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\Stream\FileResponse;

/**
 * @extends ResourceEndpoint<Envelope>
 * @method Envelope get(string $id)
 * @method Envelope create(array $body)
 * @method Envelope update(string $id, array $body)
 */
final class EnvelopesEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Envelope> */
    use CRUDEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/envelopes', Envelope::class);
    }

    /**
     * @param Envelope|string $envelope
     */
    public function documents($envelope): EnvelopeDocumentsEndpoint
    {
        return new EnvelopeDocumentsEndpoint($this, $envelope);
    }

    /**
     * @param Envelope|string $envelope
     */
    public function recipients($envelope): EnvelopeRecipientsEndpoint
    {
        return new EnvelopeRecipientsEndpoint($this, $envelope);
    }

    /**
     * @param Envelope|string $envelope
     */
    public function tags($envelope): EnvelopeTagsEndpoint
    {
        return new EnvelopeTagsEndpoint($this, $envelope);
    }

    /**
     * @param Envelope|string $envelope
     */
    public function notifications($envelope): EnvelopeNotificationsEndpoint
    {
        return new EnvelopeNotificationsEndpoint($this, $envelope);
    }

    public function cancel(string $id): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/cancel', ['id' => $id]));
    }

    public function count(): BaseResource
    {
        return $this->createResource($this->getRequest('/count'));
    }

    /**
     * @param mixed[] $query
     */
    public function download(string $id, array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/download', ['id' => $id, 'query' => $query]);
    }

    public function embedEdit(string $id): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/embed/edit', ['id' => $id]));
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
        return $this->createResource($this->postRequest('/{id}/send', ['id' => $id]));
    }
}
