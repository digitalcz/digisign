<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

class EnvelopeIri extends Iri
{
    public const TEMPLATE = '/api/envelopes/{envelope}';

    public function __construct(string $envelope)
    {
        parent::__construct(new IriTemplate(self::TEMPLATE), compact('envelope'));
    }
}
