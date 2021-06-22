<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\EnvelopeTemplate;
use DigitalCz\DigiSign\Resource\EnvelopeTemplateRecipient;

/**
 * @extends ResourceEndpoint<EnvelopeTemplateRecipient>
 * @method EnvelopeTemplateRecipient get(string $id)
 * @method EnvelopeTemplateRecipient create(array $body)
 * @method EnvelopeTemplateRecipient update(string $id, array $body)
 */
final class EnvelopeTemplateRecipientsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<EnvelopeTemplateRecipient> */
    use CRUDEndpointTrait;

    /**
     * @param EnvelopeTemplate|string $template
     */
    public function __construct(EnvelopeTemplatesEndpoint $parent, $template)
    {
        parent::__construct(
            $parent,
            '/{template}/recipients',
            EnvelopeTemplateRecipient::class,
            ['template' => $template]
        );
    }

    /**
     * @param mixed[] $body
     */
    public function signingOrder(array $body): void
    {
        $this->putRequest('/signing-order', ['json' => $body]);
    }
}
