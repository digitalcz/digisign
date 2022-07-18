<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeDocumentSignatureSheets extends BaseResource
{
    use EntityResourceTrait;

    /** @var Collection<EnvelopeDocument> */
    public $documents;

    /** @var Collection<EnvelopeTag> */
    public $tags;
}
