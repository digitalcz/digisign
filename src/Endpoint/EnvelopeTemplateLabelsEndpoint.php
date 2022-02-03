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
    /**
     * @param EnvelopeTemplate|string $template
     */
    public function __construct(EnvelopeTemplatesEndpoint $parent, $template)
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

    /**
     * @param Label|string $label
     */
    public function add($label): void
    {
        $this->putRequest('/{label}', ['label' => $label]);
    }

    /**
     * @param Label|string $label
     */
    public function remove($label): void
    {
        $this->deleteRequest('/{label}', ['label' => $label]);
    }
}
