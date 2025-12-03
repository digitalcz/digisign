<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

final class Bank extends BaseResource
{
    /** @var array<string, mixed>  */
    public array $availableLogoImages;

    /** @var array<string>  */
    public array $availableServices;
    public string $id;
    public string $title;
    public string $description;
}
