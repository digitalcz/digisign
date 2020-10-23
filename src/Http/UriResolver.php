<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Http;

final class UriResolver
{

    public const URI = 'https://api.digisign.org';
    public const URI_SANDBOX = 'https://api.digisign.digital.cz';

    /**
     * @var bool
     */
    private $sandbox;

    public function __construct(bool $sandbox = false)
    {
        $this->sandbox = $sandbox;
    }

    public function getBaseUri(): string
    {
        return $this->resolveBaseUri();
    }

    public function getCompleteUri(string $uri): string
    {
        return sprintf('%s%s', $this->getBaseUri(), $uri);
    }

    private function resolveBaseUri(): string
    {
        if ($this->sandbox) {
            return self::URI_SANDBOX;
        }

        return self::URI;
    }
}
