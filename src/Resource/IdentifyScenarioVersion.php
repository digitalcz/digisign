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
    public bool $primaryDocumentEnabled;

    /** @var array<string> */
    public array $primaryDocumentTypes;
    public bool $secondaryDocumentEnabled;

    /** @var array<string> */
    public array $secondaryDocumentTypes;
    public bool $bankStatementEnabled;
    public string $approvalMode;

    /** @var string[] */
    public ?array $ownConditions;
    public bool $selfieEnabled;
    public int $expireAfterHours;
    public int $discardCompletedAfterDays;
}
