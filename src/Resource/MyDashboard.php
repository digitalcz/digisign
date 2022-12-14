<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MyDashboard extends BaseResource
{
    public int $toSign;

    public int $forOthers;

    /** @var Collection<MyEnvelope> */
    public Collection $latest;
}
