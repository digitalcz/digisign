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
class EnvelopeNotificationsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<EnvelopeNotification> */
    use CRUDEndpointTrait;

    /**
     * @param Envelope|string $envelope
     */
    public function __construct(EnvelopesEndpoint $parent, $envelope)
    {
        parent::__construct(
            $parent,
            '/{envelope}/notifications',
            EnvelopeNotification::class,
            ['envelope' => $envelope]
        );
    }
}
