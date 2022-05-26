<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Branding extends BaseResource
{
    use EntityResourceTrait;

    /** @var string */
    public $name;

    /** @var string|null */
    public $defaultSenderName;

    /** @var string|null */
    public $defaultSenderEmail;

    /** @var Image|null */
    public $logo;

    /** @var string */
    public $logoSize;

    /** @var string|null */
    public $primaryColor;

    /** @var string|null */
    public $complementaryColor;

    /** @var string|null */
    public $secondaryColor;
}
