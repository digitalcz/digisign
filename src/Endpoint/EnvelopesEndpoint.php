<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\Resource\EnvelopeTemplate;
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

    /**
     * @param Envelope|string $envelope
     */
    public function labels($envelope): EnvelopeLabelsEndpoint
    {
        return new EnvelopeLabelsEndpoint($this, $envelope);
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

    /**
     * @param mixed[] $body
     */
    public function embedEdit(string $id, array $body = []): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/embed/edit', ['id' => $id, 'json' => $body]));
    }

    /**
     * @param mixed[] $body
     */
    public function embedSigning(string $id, array $body = []): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/embed/signing', ['id' => $id, 'json' => $body]));
    }

    /**
     * @param mixed[] $body
     */
    public function extend(string $id, array $body): Envelope
    {
        return $this->makeResource($this->putRequest('/{id}/extend', ['id' => $id, 'json' => $body]));
    }

    public function send(string $id): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/send', ['id' => $id]));
    }

    public function resend(string $id): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/resend', ['id' => $id]));
    }

    /**
     * @param Envelope|string $id
     */
    public function template($id): EnvelopeTemplate
    {
        return $this->createResource($this->getRequest('/{id}/template', ['id' => $id]), EnvelopeTemplate::class);
    }

    /**
     * @param Envelope|string $id
     */
    public function clone($id): Envelope
    {
        return $this->makeResource($this->postRequest('/{id}/clone', ['id' => $id]));
    }

    /**
     * @param Envelope|string $id
     */
    public function discard($id): Envelope
    {
        return $this->makeResource($this->postRequest('/{id}/discard', ['id' => $id]));
    }

    /**
     * @param Envelope|string $id
     */
    public function restore($id): Envelope
    {
        return $this->makeResource($this->postRequest('/{id}/restore', ['id' => $id]));
    }
}
