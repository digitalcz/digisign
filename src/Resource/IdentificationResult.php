<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class IdentificationResult extends BaseResource
{
    use EntityResourceTrait;

    public ?IdentificationDocument $primaryDocument;
    public ?IdentificationDocument $secondaryDocument;
    public ?IdentificationBankStatement $bankStatement;
    public ?IdentificationSelfie $selfie;
    public ?IdentificationInspection $inspection;
}
