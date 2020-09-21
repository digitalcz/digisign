<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Model\Iri;

class EnvelopeRecipientIri extends ResourceIri
{
    public const TEMPLATE = EnvelopeIri::TEMPLATE . '/recipients/{recipient}';
}
