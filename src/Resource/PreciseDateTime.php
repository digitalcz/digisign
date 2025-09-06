<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

/**
 * DateTime class that always includes milliseconds in serialization
 */
class PreciseDateTime extends DateTime
{
}
