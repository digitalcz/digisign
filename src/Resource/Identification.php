<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;
use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class Identification extends BaseResource
{
    use EntityResourceTrait;

    public ?string $name;
    public string $status;
    public string $language;
    public ?string $envelope;
    public ?string $redirectUrl;
    public ?DateTime $startedAt;
    public ?DateTime $openedAt;
    public ?DateTime $completedAt;
}
