<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\AccountEnvelopeTemplate;

/**
 * @extends ResourceEndpoint<AccountEnvelopeTemplate>
 */
final class AccountEnvelopeTemplateEndpoint extends ResourceEndpoint
{
    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/envelope-template', AccountEnvelopeTemplate::class);
    }

    public function get(): AccountEnvelopeTemplate
    {
        return $this->makeResource($this->getRequest());
    }

    /**
     * @param mixed[] $body
     */
    public function update(array $body): AccountEnvelopeTemplate
    {
        return $this->makeResource($this->putRequest('', ['json' => $body]));
    }
}
