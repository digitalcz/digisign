<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

/**
 * DateTime class that always includes milliseconds in serialization
 */
class PreciseDateTime extends DateTime
{
    public const MILLIS = 'Y-m-d\TH:i:s.vP';
}
