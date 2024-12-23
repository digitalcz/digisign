<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MyPreferences extends BaseResource
{
    public bool $prefillAsRecipient;
    public bool $autoscrollTags;
    public bool $welcomeVideoHide;
    public bool $welcomeVideoClose;
}
