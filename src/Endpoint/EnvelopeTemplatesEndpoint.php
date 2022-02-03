<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Endpoint\Traits\CRUDEndpointTrait;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\Resource\EnvelopeTemplate;

/**
 * @extends ResourceEndpoint<EnvelopeTemplate>
 * @method EnvelopeTemplate get(string $id)
 * @method EnvelopeTemplate create(array $body)
 * @method EnvelopeTemplate update(string $id, array $body)
 */
final class EnvelopeTemplatesEndpoint extends ResourceEndpoint
{
    /** @use CRUDEndpointTrait<EnvelopeTemplate> */
    use CRUDEndpointTrait;

    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/envelope-templates', EnvelopeTemplate::class);
    }

    /**
     * @param EnvelopeTemplate|string $template
     */
    public function clone($template): EnvelopeTemplate
    {
        return $this->createResource($this->postRequest('/{id}/clone', ['id' => $template]), EnvelopeTemplate::class);
    }

    /**
     * @param EnvelopeTemplate|string $template
     */
    public function use($template): Envelope
    {
        return $this->createResource($this->postRequest('/{id}/use', ['id' => $template]), Envelope::class);
    }

    /**
     * @param EnvelopeTemplate|string $template
     */
    public function documents($template): EnvelopeTemplateDocumentsEndpoint
    {
        return new EnvelopeTemplateDocumentsEndpoint($this, $template);
    }

    /**
     * @param EnvelopeTemplate|string $template
     */
    public function recipients($template): EnvelopeTemplateRecipientsEndpoint
    {
        return new EnvelopeTemplateRecipientsEndpoint($this, $template);
    }

    /**
     * @param EnvelopeTemplate|string $template
     */
    public function notifications($template): EnvelopeTemplateNotificationsEndpoint
    {
        return new EnvelopeTemplateNotificationsEndpoint($this, $template);
    }

    /**
     * @param EnvelopeTemplate|string $template
     */
    public function tags($template): EnvelopeTemplateTagsEndpoint
    {
        return new EnvelopeTemplateTagsEndpoint($this, $template);
    }

    /**
     * @param EnvelopeTemplate|string $template
     */
    public function labels($template): EnvelopeTemplateLabelsEndpoint
    {
        return new EnvelopeTemplateLabelsEndpoint($this, $template);
    }
}
