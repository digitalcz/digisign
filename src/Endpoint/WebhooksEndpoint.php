<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\ResourceInterface;
use DigitalCz\DigiSign\Resource\Webhook;

/**
 * @extends ResourceEndpoint<Webhook>
 * @method Webhook get(string $id)
 * @method Webhook create(array $body)
 * @method Webhook update(string $id, array $body)
 */
final class WebhooksEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<Webhook> */
    use CRUDEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/webhooks', Webhook::class);
    }

    public function attempts(Webhook|string $webhook): WebhookAttemptsEndpoint
    {
        return new WebhookAttemptsEndpoint($this, $webhook);
    }

    public function test(string $id): ResourceInterface
    {
        return $this->createResource($this->postRequest('/{id}/test', ['id' => $id]));
    }
}
