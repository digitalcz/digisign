<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedVerification extends BaseResource
{
    /** @var string|null */
    public $trustFramework;

    /** @var string|null */
    public $time;

    /** @var string|null */
    public $verificationProcess;
}
