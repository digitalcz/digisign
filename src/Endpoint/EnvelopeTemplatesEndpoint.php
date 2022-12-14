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

    public function clone(EnvelopeTemplate|string $template): EnvelopeTemplate
    {
        return $this->createResource($this->postRequest('/{id}/clone', ['id' => $template]), EnvelopeTemplate::class);
    }

    public function use(EnvelopeTemplate|string $template): Envelope
    {
        return $this->createResource($this->postRequest('/{id}/use', ['id' => $template]), Envelope::class);
    }

    public function documents(EnvelopeTemplate|string $template): EnvelopeTemplateDocumentsEndpoint
    {
        return new EnvelopeTemplateDocumentsEndpoint($this, $template);
    }

    public function recipients(EnvelopeTemplate|string $template): EnvelopeTemplateRecipientsEndpoint
    {
        return new EnvelopeTemplateRecipientsEndpoint($this, $template);
    }

    public function notifications(EnvelopeTemplate|string $template): EnvelopeTemplateNotificationsEndpoint
    {
        return new EnvelopeTemplateNotificationsEndpoint($this, $template);
    }

    public function tags(EnvelopeTemplate|string $template): EnvelopeTemplateTagsEndpoint
    {
        return new EnvelopeTemplateTagsEndpoint($this, $template);
    }

    public function labels(EnvelopeTemplate|string $template): EnvelopeTemplateLabelsEndpoint
    {
        return new EnvelopeTemplateLabelsEndpoint($this, $template);
    }
}
