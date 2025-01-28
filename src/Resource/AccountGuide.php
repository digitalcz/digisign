<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class AccountGuide extends BaseResource
{
    public bool $firstEnvelopeSent;
    public bool $firstUserInvited;
    public bool $settingFilled;
}
