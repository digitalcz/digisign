<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class EnvelopeDocumentSignatureSheets extends BaseResource
{
    /** @var Collection<EnvelopeDocument> */
    public Collection $documents;

    /** @var Collection<EnvelopeTag> */
    public Collection $tags;
}
