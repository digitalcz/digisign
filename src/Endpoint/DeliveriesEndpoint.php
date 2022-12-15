<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\Delivery;

/**
 * @extends ResourceEndpoint<Delivery>
 * @method Delivery get(string $id)
 * @method Delivery create(array $body)
 * @method Delivery update(string $id, array $body)
 */
final class DeliveriesEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Delivery> */
    use CRUDEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/deliveries', Delivery::class);
    }

    public function documents(Delivery|string $delivery): DeliveryDocumentsEndpoint
    {
        return new DeliveryDocumentsEndpoint($this, $delivery);
    }

    public function recipients(Delivery|string $delivery): DeliveryRecipientsEndpoint
    {
        return new DeliveryRecipientsEndpoint($this, $delivery);
    }

    public function cancel(string $id): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/cancel', ['id' => $id]));
    }

    public function send(string $id): BaseResource
    {
        return $this->createResource($this->postRequest('/{id}/send', ['id' => $id]));
    }
}
