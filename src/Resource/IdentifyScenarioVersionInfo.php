<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class IdentifyScenarioVersionInfo extends BaseResource
{
    public string $id;
    public int $version;
    public string $approvalMode;
    public IdentifyScenarioInfo $scenario;
}
