<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class AccountSecurity extends BaseResource
{
    use EntityResourceTrait;

    /** @var bool */
    public $reuseRecipientAuthentication;

    /** @var string|null  */
    public $oidcPrompt;

    /** @var bool  */
    public $oidcLoginHint;

    /** @var bool  */
    public $oidcDomainHint;

    /** @var int */
    public $discardedEnvelopeRetention;

    /** @var bool  */
    public $continuousSigning;
}
