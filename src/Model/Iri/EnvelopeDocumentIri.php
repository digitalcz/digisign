<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

class EnvelopeDocumentIri extends ResourceIri
{
    public const TEMPLATE = EnvelopeIri::TEMPLATE . '/documents/{document}';
}
