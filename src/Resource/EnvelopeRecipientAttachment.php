<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeRecipientAttachment extends BaseResource
{
    use EntityResourceTrait;

    public string $recipient;

    public string $type;

    public File $file;

    public ?string $name = null;
}
