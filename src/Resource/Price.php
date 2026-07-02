<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class Price extends BaseResource
{
    public ?float $amount;
    public string $currency;
    public Period $period;
}
