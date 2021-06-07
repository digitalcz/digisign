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
class WebhookAttemptsEndpoint extends ResourceEndpoint
{
    /** @use ListEndpointTrait<WebhookAttempt> */
    use ListEndpointTrait;
    use GetEndpointTrait;

    /**
     * @param Webhook|string $webhook
     */
    public function __construct(WebhooksEndpoint $parent, $webhook)
    {
        parent::__construct($parent, '/{webhook}/attempts', WebhookAttempt::class, ['webhook' => $webhook]);
    }

    public function resend(string $id): WebhookAttempt
    {
        return $this->makeResource($this->postRequest('/{id}/resend', ['id' => $id]));
    }
}
