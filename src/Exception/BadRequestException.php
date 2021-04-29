<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Exception;

use DigitalCz\DigiSign\Resource\Violations;

/**
 * Represents response with http status 400
 */
class BadRequestException extends ClientException
{
    public function getViolations(): ?Violations
    {
        try {
            return new Violations($this->parseResult());
        } catch (EmptyResultException $e) {
            return null;
        }
    }
}
