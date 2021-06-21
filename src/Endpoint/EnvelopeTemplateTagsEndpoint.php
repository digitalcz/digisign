<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\EnvelopeTemplate;
use DigitalCz\DigiSign\Resource\EnvelopeTemplateTag;

/**
 * @extends ResourceEndpoint<EnvelopeTemplateTag>
 * @method EnvelopeTemplateTag get(string $id)
 * @method EnvelopeTemplateTag create(array $body)
 * @method EnvelopeTemplateTag update(string $id, array $body)
 */
final class EnvelopeTemplateTagsEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<EnvelopeTemplateTag> */
    use CRUDEndpointTrait;

    /**
     * @param EnvelopeTemplate|string $template
     */
    public function __construct(EnvelopeTemplatesEndpoint $parent, $template)
    {
        parent::__construct($parent, '/{template}/tags', EnvelopeTemplateTag::class, ['template' => $template]);
    }
}
