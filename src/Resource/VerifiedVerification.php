<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class VerifiedVerification extends BaseResource
{
    public ?string $trustFramework = null;

    public ?string $time = null;

    public ?string $verificationProcess = null;
}
