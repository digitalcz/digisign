<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Resource\BaseResource;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
final class MyEndpoint extends ResourceEndpoint
{
    public function __construct(DigiSign $parent)
    {
        parent::__construct($parent, '/api/my');
    }

    public function dashboard(): MyDashboardEndpoint
    {
        return new MyDashboardEndpoint($this);
    }

    public function envelopes(): MyEnvelopesEndpoint
    {
        return new MyEnvelopesEndpoint($this);
    }
}
