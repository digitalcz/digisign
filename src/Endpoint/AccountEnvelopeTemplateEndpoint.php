<?php

declare(strict_types=1);

namespace DigitalCz\DigiSign\Endpoint;

use DigitalCz\DigiSign\Resource\EnvelopeTemplate;

/**
 * @extends ResourceEndpoint<EnvelopeTemplate>
 */
final class AccountEnvelopeTemplateEndpoint extends ResourceEndpoint
{
    public function __construct(AccountEndpoint $parent)
    {
        parent::__construct($parent, '/envelope-template', EnvelopeTemplate::class);
    }

    public function get(): EnvelopeTemplate
    {
        return $this->makeResource($this->getRequest());
    }

    /**
     * @param mixed[] $body
     */
    public function update(array $body): EnvelopeTemplate
    {
        return $this->makeResource($this->putRequest('', ['json' => $body]));
    }
}
