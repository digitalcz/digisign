<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Delivery;
use DigitalCz\DigiSign\Resource\DeliveryDocument;
use DigitalCz\DigiSign\Stream\FileResponse;

/**
 * @extends ResourceEndpoint<DeliveryDocument>
 * @method DeliveryDocument get(string $id)
 * @method DeliveryDocument create(array $body)
 * @method DeliveryDocument update(string $id, array $body)
 */
final class DeliveryDocumentsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<DeliveryDocument> */
    use CRUDEndpointTrait;

    public function __construct(DeliveriesEndpoint $parent, Delivery|string $delivery)
    {
        parent::__construct($parent, '/{delivery}/documents', DeliveryDocument::class, ['delivery' => $delivery]);
    }

    /**
     * @param mixed[] $body
     */
    public function positions(array $body): void
    {
        $this->putRequest('/positions', ['json' => $body]);
    }

    /**
     * @param mixed[] $query
     */
    public function download(string $id, array $query = []): FileResponse
    {
        return $this->stream(self::METHOD_GET, '/{id}/download', ['id' => $id, 'query' => $query]);
    }
}
