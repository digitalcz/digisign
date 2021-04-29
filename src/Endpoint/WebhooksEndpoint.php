<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CreateEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\DeleteEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\GetEndpointTrait;
use DigitalCz\DigiSign\Endpoint\Traits\ListEndpointTrait;
use DigitalCz\DigiSign\Resource\Webhook;

/**
 * @extends ResourceEndpoint<Webhook>
 * @method Webhook get(string $id)
 * @method Webhook create(array $body)
 */
class WebhooksEndpoint extends ResourceEndpoint
{
    use CreateEndpointTrait;
    use ListEndpointTrait;
    use GetEndpointTrait;
    use DeleteEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/webhooks', Webhook::class);
    }
}
