<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class AccountSecurity extends BaseResource
{
    use EntityResourceTrait;

    public bool $reuseRecipientAuthentication;

    public ?string $oidcPrompt = null;

    public bool $oidcLoginHint;

    public bool $oidcDomainHint;

    public int $discardedEnvelopeRetention;

    public bool $continuousSigning;

    public bool $auditLogDownloadDefaultUnchecked;
}
