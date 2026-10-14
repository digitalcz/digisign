<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\Webhook;
use DigitalCz\DigiSign\Resource\WebhookAttempt;

/**
 * @extends ResourceEndpoint<WebhookAttempt>
 * @method WebhookAttempt get(string $id)
 */
final class WebhookAttemptsEndpoint extends ResourceEndpoint
{
    use GetEndpointTrait;
    /** @use ListEndpointTrait<WebhookAttempt> */
    use ListEndpointTrait;

    public function __construct(WebhooksEndpoint $parent, Webhook|string $webhook)
    {
        parent::__construct($parent, '/{webhook}/attempts', WebhookAttempt::class, ['webhook' => $webhook]);
    }

    public function resend(string $id): WebhookAttempt
    {
        return $this->makeResource($this->postRequest('/{id}/resend', ['id' => $id]));
    }
}
