<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Exception;

use Throwable;

/**
 * @codeCoverageIgnore
 */
final class EmptyResultException extends RuntimeException
{
    public function __construct(?Throwable $previous = null)
    {
        parent::__construct('Empty result', 0, $previous);
    }
}
