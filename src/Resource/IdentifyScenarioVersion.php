<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DateTime;

class IdentifyScenarioVersion extends BaseResource
{
    public string $id;
    public DateTime $createdAt;
    public int $version;
    public bool $latest;
    public Blame $createdBlame;
}
