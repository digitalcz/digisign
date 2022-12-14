<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\EnvelopeTemplate;
use DigitalCz\DigiSign\Resource\Label;

/**
 * @extends ResourceEndpoint<Label>
 */
final class EnvelopeTemplateLabelsEndpoint extends ResourceEndpoint
{
    public function __construct(EnvelopeTemplatesEndpoint $parent, EnvelopeTemplate|string $template)
    {
        parent::__construct($parent, '/{template}/labels', Label::class, ['template' => $template]);
    }

    /**
     * @return Collection<Label>
     */
    public function all(): Collection
    {
        return $this->createCollectionResource($this->getRequest(), $this->getResourceClass());
    }

    /**
     * @param array<string> $body
     * @return Collection<Label>
     */
    public function set(array $body): Collection
    {
        return $this->createCollectionResource($this->putRequest('', ['json' => $body]), $this->getResourceClass());
    }

    public function add(Label|string $label): void
    {
        $this->putRequest('/{label}', ['label' => $label]);
    }

    public function remove(Label|string $label): void
    {
        $this->deleteRequest('/{label}', ['label' => $label]);
    }
}
