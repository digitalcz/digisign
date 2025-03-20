<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\BaseResource;

/**
 * @extends ResourceEndpoint<BaseResource>
 */
class AccountIdentifyScenariosInspectionChecksEndpoint extends ResourceEndpoint
{
    public function __construct(AccountIdentifyScenariosEndpoint $parent)
    {
        parent::__construct($parent, '/inspection-checks');
    }

    /**
     * @return array<string, string>
     */
    public function defaults(): array
    {
        /** @var array<string, string> $result */
        $result = $this->parseResponse($this->getRequest('/defaults'));

        return $result;
    }
}
