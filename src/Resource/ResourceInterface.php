<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Exception\RuntimeException;
use JsonSerializable;
use Psr\Http\Message\ResponseInterface;

interface ResourceInterface extends JsonSerializable
{
    /**
     * Returns original API response
     *
     * @return ResponseInterface The original response
     *
     * @throws RuntimeException If this resource has no Response set
     */
    public function getResponse(): ResponseInterface;

    /**
     * Set original API response
     */
    public function setResponse(ResponseInterface $response): void;

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

    /**
     * Returns ID for Resource, null if Resource has no ID
     */
    public function id(): ?string;
}
