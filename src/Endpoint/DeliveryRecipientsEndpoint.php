<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\DeliveryRecipient;
use DigitalCz\DigiSign\Resource\ResourceInterface;

/**
 * @extends ResourceEndpoint<DeliveryRecipient>
 * @method DeliveryRecipient get(string $id)
 * @method DeliveryRecipient create(array $body)
 * @method DeliveryRecipient update(string $id, array $body)
 */
class DeliveryRecipientsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<DeliveryRecipient> */
    use CRUDEndpointTrait;

    public function __construct(DeliveriesEndpoint $parent, string $delivery)
    {
        parent::__construct($parent, '/{delivery}/recipients', DeliveryRecipient::class, ['delivery' => $delivery]);
    }

    public function block(string $id): RecipientBlockEndpoint
    {
        return new RecipientBlockEndpoint($this, $id);
    }

    public function resend(string $id): ResourceInterface
    {
        return $this->createResource($this->postRequest('/{id}/resend', ['id' => $id]));
    }
}
