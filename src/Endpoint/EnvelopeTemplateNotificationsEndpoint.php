<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\EnvelopeTemplate;
use DigitalCz\DigiSign\Resource\EnvelopeTemplateNotification;

/**
 * @extends ResourceEndpoint<EnvelopeTemplateNotification>
 * @method EnvelopeTemplateNotification get(string $id)
 * @method EnvelopeTemplateNotification create(mixed[] $body)
 * @method EnvelopeTemplateNotification update(string $id, mixed[] $body)
 */
final class EnvelopeTemplateNotificationsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<EnvelopeTemplateNotification> */
    use CRUDEndpointTrait;

    public function __construct(EnvelopeTemplatesEndpoint $parent, EnvelopeTemplate|string $template)
    {
        parent::__construct(
            $parent,
            '/{template}/notifications',
            EnvelopeTemplateNotification::class,
            ['template' => $template],
        );
    }
}
