<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

class EnvelopeTagIri extends ResourceIri
{
    public const TEMPLATE = EnvelopeIri::TEMPLATE . '/tags/{tag}';
}
