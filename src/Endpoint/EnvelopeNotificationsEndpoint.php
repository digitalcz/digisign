<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\Resource\EnvelopeNotification;

/**
 * @extends ResourceEndpoint<EnvelopeNotification>
 * @method EnvelopeNotification get(string $id)
 * @method EnvelopeNotification create(array $body)
 * @method EnvelopeNotification update(string $id, array $body)
 */
final class EnvelopeNotificationsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<EnvelopeNotification> */
    use CRUDEndpointTrait;

    public function __construct(EnvelopesEndpoint $parent, Envelope|string $envelope)
    {
        parent::__construct(
            $parent,
            '/{envelope}/notifications',
            EnvelopeNotification::class,
            ['envelope' => $envelope],
        );
    }
}
