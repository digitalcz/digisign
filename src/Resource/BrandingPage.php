<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class BrandingPage extends BaseResource
{
    public string $mode;

    /** @var array<string, string>|null */
    public ?array $content = null;

    /** @var array<string, string>|null */
    public ?array $redirectUrl = null;

    public bool $showFooter = true;
}
