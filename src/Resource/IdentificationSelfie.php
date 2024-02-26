<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class IdentificationSelfie extends BaseResource
{
    use EntityResourceTrait;

    public Image $image;
}
