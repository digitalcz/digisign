<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BillingProfile;

/**
 * @extends ResourceEndpoint<BillingProfile>
 */
final class BillingProfileEndpoint extends ResourceEndpoint
{
    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/billing-profile', BillingProfile::class);
    }

    public function get(): BillingProfile
    {
        return $this->makeResource($this->getRequest(''));
    }

    /**
     * @param mixed[] $body
     */
    public function update(array $body): BillingProfile
    {
        return $this->makeResource($this->putRequest('', ['json' => $body]));
    }
}
