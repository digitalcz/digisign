<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\BulkSignature;
use DigitalCz\DigiSign\Resource\ResourceInterface;

/**
 * @extends ResourceEndpoint<BulkSignature>
 */
final class BulkSignatureEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;
    /** @use ListEndpointTrait<BulkSignature> */
    use ListEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/bulk-signatures', BulkSignature::class);
    }

    public function resend(string $id): ResourceInterface
    {
        return $this->createResource($this->postRequest('/{id}/resend', ['id' => $id]));
    }
}
