<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\Collection;
use DigitalCz\DigiSign\Resource\Envelope;
use DigitalCz\DigiSign\Resource\Label;

/**
 * @extends ResourceEndpoint<Label>
 */
final class EnvelopeLabelsEndpoint extends ResourceEndpoint
{
    /**
     * @param Envelope|string $envelope
     */
    public function __construct(EnvelopesEndpoint $parent, $envelope)
    {
        parent::__construct($parent, '/{envelope}/labels', Label::class, ['envelope' => $envelope]);
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
