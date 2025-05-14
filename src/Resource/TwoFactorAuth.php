<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

final class TwoFactorAuth extends BaseResource
{
    public string $status;
    public string $type;
}
