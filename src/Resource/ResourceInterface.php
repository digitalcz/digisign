<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use JsonSerializable;

interface ResourceInterface extends JsonSerializable
{
    /**
     * Returns original values from API response
     *
     * @return mixed[]
     */
    public function getResult(): array;

    /**
     * Returns array representation of Resource
     *
     * @return mixed[]
     */
    public function toArray(): array;

    /**
     * Returns IRI for Resource, null if Resource has no IRI
     */
    public function self(): ?string;
}
