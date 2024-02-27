<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\Identification;
use DigitalCz\DigiSign\Stream\FileResponse;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class IdentificationDocumentEndpoint extends ResourceEndpoint
{
    public function __construct(
        IdentificationsEndpoint $parent,
        Identification|string $identification,
        string $resourcePath,
    ) {
        parent::__construct($parent, "/{id}$resourcePath", resourceOptions: ['id' => $identification]);
    }

    /**
     * @param array<string, mixed> $query
     */
    public function front(array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/front', ['query' => $query]);
    }

    /**
     * @param array<string, mixed> $query
     */
    public function back(array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/back', ['query' => $query]);
    }
}
