<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class SignatureScenarioVersionInfo extends BaseResource
{
    public string $id;
    public string $name;
    public SignatureScenarioVersion $version;
}
