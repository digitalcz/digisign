<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class IdentificationInspection extends BaseResource
{
    use EntityResourceTrait;

    public InspectionClaims $claims;
}
