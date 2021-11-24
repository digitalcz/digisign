<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeRecipientAttachment extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $recipient;

    /** @var string */
    public $type;

    /** @var File */
    public $file;

    /** @var string|null */
    public $name;
}
