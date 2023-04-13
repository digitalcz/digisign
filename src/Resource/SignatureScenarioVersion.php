<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

use DigitalCz\DigiSign\Resource\Traits\EntityResourceTrait;

class SignatureScenarioVersion extends BaseResource
{
    use EntityResourceTrait;

    public int $version;

    /** @var Collection<SignatureScenarioVariant> */
    public Collection $variants;
    public string $role;
    public string $channelForSigner;
    public string $channelForDownload;
    public string $authenticationOnDownload;
    public Blame $createdBlame;

    /** @var array<string, string> */
    public array $bankIdScopes;

    /** @var array<string, string> */
    public array $visibleFields;

    /** @var array<string, string> */
    public array $validatedFields;
    public bool $delegation;
    public bool $latest;
}
