<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class EnvelopeTemplateRecipient extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $alias;

    /** @var string */
    public $role;

    /** @var string|null */
    public $name;

    /** @var string|null */
    public $email;

    /** @var string|null */
    public $mobile;

    /** @var string|null */
    public $emailBody;

    /** @var string */
    public $language;

    /** @var int */
    public $signingOrder;
}
