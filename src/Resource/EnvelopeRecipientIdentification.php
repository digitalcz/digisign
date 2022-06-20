<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class EnvelopeRecipientIdentification extends BaseResource
{
    /** @var DateTime */
    public $createdAt;

    /** @var string */
    public $product;

    /** @var mixed[]|null */
    public $bank;

    /** @var string */
    public $place;

    /** @var bool */
    public $authenticated;

    /** @var string|null */
    public $error;

    /** @var VerifiedClaims|null */
    public $claims;
}
