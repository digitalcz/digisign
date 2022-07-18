<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class EnvelopeDocumentSignatureSheets extends BaseResource
{
    /** @var Collection<EnvelopeDocument> */
    public $documents;

    /** @var Collection<EnvelopeTag> */
    public $tags;
}
