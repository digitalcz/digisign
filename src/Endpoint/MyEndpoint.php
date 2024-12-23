<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\DigiSign;
use DigitalCz\DigiSign\Resource\BaseResource;
use DigitalCz\DigiSign\Resource\MyInfo;
use DigitalCz\DigiSign\Resource\MyPreferences;

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

    public function accounts(): MyAccountsEndpoint
    {
        return new MyAccountsEndpoint($this);
    }

    public function contacts(): MyContactsEndpoint
    {
        return new MyContactsEndpoint($this);
    }

    public function info(): MyInfo
    {
        return $this->createResource($this->getRequest('/info'), MyInfo::class);
    }

    public function identifications(): MyIdentificationsEndpoint
    {
        return new MyIdentificationsEndpoint($this);
    }

    /**
     * @param mixed[] $body
     */
    public function updatePreferences(array $body): MyPreferences
    {
        return $this->createResource(
            $this->putRequest('/preferences', ['json' => $body]),
            MyPreferences::class,
        );
    }
}
