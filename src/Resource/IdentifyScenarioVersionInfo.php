<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class IdentifyScenarioVersionInfo extends BaseResource
{
    public string $id;
    public string $name;
    public IdentifyScenarioVersion $version;
}
