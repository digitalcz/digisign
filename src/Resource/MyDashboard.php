<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Resource;

class MyDashboard extends BaseResource
{
    /** @var int */
    public $toSign;

    /** @var int */
    public $forOthers;

    /** @var Collection<MyEnvelope> */
    public $latest;
}
