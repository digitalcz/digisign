<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Delivery;
use DigitalCz\DigiSign\Resource\DeliveryRecipient;
use DigitalCz\DigiSign\Resource\ResourceInterface;

/**
 * @extends ResourceEndpoint<DeliveryRecipient>
 * @method DeliveryRecipient get(string $id)
 * @method DeliveryRecipient create(array $body)
 * @method DeliveryRecipient update(string $id, array $body)
 */
final class DeliveryRecipientsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<DeliveryRecipient> */
    use CRUDEndpointTrait;

    /**
     * @param Delivery|string $delivery
     */
    public function __construct(DeliveriesEndpoint $parent, $delivery)
    {
        parent::__construct($parent, '/{delivery}/recipients', DeliveryRecipient::class, ['delivery' => $delivery]);
    }

    /**
     * @param DeliveryRecipient|string $recipient
     */
    public function block($recipient): RecipientBlockEndpoint
    {
        return new RecipientBlockEndpoint($this, $recipient);
    }

    public function resend(string $id): ResourceInterface
    {
        return $this->createResource($this->postRequest('/{id}/resend', ['id' => $id]));
    }
}
