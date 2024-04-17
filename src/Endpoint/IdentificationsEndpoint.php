<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\DeleteEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\Identification;
use DigitalCz\DigiSign\Resource\IdentificationResult;
use DigitalCz\DigiSign\Stream\FileResponse;

/**
 * @extends ResourceEndpoint<Identification>
 * @method Identification get(string $id)
 * @method Identification create(array $body)
 * @method Identification update(string $id, array $body)
 */
final class IdentificationsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<Identification> */
    use ListEndpointTrait;
    use GetEndpointTrait;
    use DeleteEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/identifications', Identification::class);
    }

    public function approve(Identification|string $id): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/approve', ['id' => $id]));
    }

    /**
     * @param array<string, mixed> $query
     */
    public function bankStatement(Identification|string $id, array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/bank-statement', ['id' => $id, 'query' => $query]);
    }

    public function cancel(Identification|string $id): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/cancel', ['id' => $id]));
    }

    /**
     * @param mixed[] $body
     */
    public function deny(Identification|string $id, array $body = []): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/deny', ['id' => $id, 'json' => $body]));
    }

    /**
     * @param mixed[] $body
     */
    public function discard(Identification|string $id, array $body = []): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/discard', ['id' => $id, 'json' => $body]));
    }

    public function primaryDocument(Identification|string $id): IdentificationDocumentEndpoint
    {
        return new IdentificationDocumentEndpoint($this, $id, '/primary-document');
    }

    /**
     * @param array<string, mixed> $query
     */
    public function protocol(Identification|string $id, array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/protocol', ['id' => $id, 'query' => $query]);
    }

    public function secondaryDocument(Identification|string $id): IdentificationDocumentEndpoint
    {
        return new IdentificationDocumentEndpoint($this, $id, '/secondary-document');
    }

    /**
     * @param array<string, mixed> $query
     */
    public function selfie(Identification|string $id, array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/selfie', ['id' => $id, 'query' => $query]);
    }

    public function restore(Identification|string $id): Identification
    {
        return $this->makeResource($this->postRequest('/{id}/restore', ['id' => $id]));
    }

    /**
     * @param mixed[] $body
     */
    public function updateResult(Identification|string $id, array $body = []): IdentificationResult
    {
        return $this->createResource(
            $this->putRequest('/{id}/result', ['id' => $id, 'json' => $body]),
            IdentificationResult::class,
        );
    }
}
